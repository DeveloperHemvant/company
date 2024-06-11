<?php

namespace App\Imports;

use App\Models\admission_session;
use App\Models\User;
use App\Models\Cousre;
use App\Models\specializations;
use App\Models\Students;
use App\Models\University;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;

class StudentsImport implements ToModel, WithValidation, WithHeadingRow
{
    use Importable;

    private $successCount = 0;
    private $failureCount = 0;
    private $errors = [];
    private $skippedUniversities;

    public function model(array $row)
    {
        // dd($row);
        // Fetch all university names from the database
        $databaseUniversity = University::pluck('university_name')->toArray();
        
        // Validate the incoming row data
        $validator = Validator::make($row, [
            'university' => 'required|in:' . implode(',', $databaseUniversity),
            'aadhar_no' => [
                'required',
                Rule::unique('students')->where(function ($query) use ($row) {
                    return $query->where('aadhar_no', $row['aadhar_no'])
                                 ->where('session_id', $row['session'])
                                 ->where('course_id', $row['course']);
                }),
            ],
        ], [
            'university.in' => 'The university name in the Excel sheet does not match any university in the database.',
            'aadhar_no.unique' => 'The combination of Aadhar number, session, and course must be unique.',
        ]);

        // Handle validation failures
        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                $this->errors[] = $message;
            }
            $this->failureCount++;

            // Track skipped university names
            $universityName = $row['university'];
            if (!in_array($universityName, $databaseUniversity)) {
                if (isset($this->skippedUniversities[$universityName])) {
                    $this->skippedUniversities[$universityName]++;
                } else {
                    $this->skippedUniversities[$universityName] = 1;
                }
            }
            return null; // Skip the row
        }

        // Fetch IDs and other relevant data
        $university = University::where('university_name', $row['university'])->value('id');
        $course = Cousre::where('course_name', $row['course'])->value('id');
        $session = admission_session::where('name', $row['session'])->value('id');
        $specialization = specializations::where('cousre_id', $course)
                                        ->where('specialization_name', $row['spl'])
                                        ->value('id');
        $user_id = User::where('name', $row['associate'])->where('usertype', 'associate')->value('id');

        // Handle the case where university ID is not found
        if (!$university) {
            $this->errors[] = "University ID not found for university name: " . $row['university'];
            return null; // Skip the row
        }

        // Handle the case where course ID is not found
        if (!$course) {
            $this->errors[] = "Course ID not found for course name: " . $row['course'];
            return null; // Skip the row
        }

        // Handle the case where session ID is not found
        if (!$session) {
            $this->errors[] = "Session ID not found for session name: " . $row['session'];
            return null; // Skip the row
        }
        if (!$specialization) {
            $this->errors[] = "Specialization not found: " . $row['spl'];
            return null; // Skip the row
        }

        // Generate new student ID
        $lastId = Students::latest('id')->value('id');
        $newId = $lastId + 1;

        // Increment success count
        $this->successCount++;

        // Create new student instance
        return new Students([
            'id' => $newId,
            'university_id' => $university,
            'session_id' => $session,
            'associate' => $row['associate'],
            'user_id' => $user_id,
            'source' => $row['source'],
            'sr_no' => $row['sr_no'],
            'uni_reg_no' => $row['uni_reg_no'],
            'password' => $row['password'],
            'name' => $row['name'],
            'father_name' => $row['father_name'],
            'mother_name' => $row['mother_name'],
            'dob' => $row['dob'],
            'aadhar_no' => $row['aadhar_no'],
            'email_id' => $row['email_id'],
            'address' => $row['address'],
            'mob_no' => $row['mob_no'],
            'course_id' => $course,
            'specialization_id' => $specialization,
            'type' => $row['type'],
            'sem_year' => $row['semyear'],
            'previous_migration' => $row['previous_migration'],
            'fee' => $row['fee'],
            'exam_status' => $row['exam_status'],
            'project_status' => $row['project_status'],
            'uni_visit_date' => $row['uni_visit_date'],
            'pass_back' => $row['passback'],
            'marksheet_1st_sem' => $row['marksheet_1st_sem'],
            'marksheet_2nd_sem' => $row['marksheet_2nd_sem'],
            'marksheet_3rd_sem' => $row['marksheet_3rd_sem'],
            'marksheet_4th_sem' => $row['marksheet_4th_sem'],
            'marksheet_5th_sem' => $row['marksheet_5th_sem'],
            'marksheet_6th_sem' => $row['marksheet_6th_sem'],
            'marksheet_7th_sem' => $row['marksheet_7th_sem'],
            'marksheet_8th_sem' => $row['marksheet_8th_sem'],
            'provisional_diploma_degree' => $row['provisionaldiplomadegree'],
            'additional_docs' => $row['additional_docs'],
            'additional_remarks' => $row['additional_remarks'],
            'nc' => $row['nc'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
        ]);
    }

    public function rules(): array
    {
        return [];
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getFailureCount()
    {
        return $this->failureCount;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getSkippedUniversities()
    {
        return $this->skippedUniversities;
    }
}
