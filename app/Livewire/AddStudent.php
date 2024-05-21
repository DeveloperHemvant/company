<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\Students;
use Livewire\Component;
use App\Models\admission_session;
use App\Models\Cousre;
use App\Models\specializations;
use App\Models\University;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

// use Barryvdh\DomPDF\Facade as PDF;


class AddStudent extends Component
{
    public $session_name;
    public $specialization;
    public $admission_type;
    public $course;
    public $sessions;
    public $courses;
    public $universities;
    public $university;
    public $selectedCourse = null;
    public $fname;
    public $lname;
    public $father_name;
    public $mother_name;
    public $dob;
    public $email;
    public $mob;
    public $address;
    public $pmigration;
    public $fee;
    public $exam_status;
    public $prj_status;
    public $visit_date;
    public $pass_back;
    public $board;
    public $source;
    public $associate;
    public $selectedassociate;
    public $adhaar;
    public $semester;
    public $selectedspecialization;
    public $documents;
    public $aadhar_no;

    use WithFileUploads;

    public function addstudent()
    {
        try {

            $validatedData = $this->validate([

                'university' => 'required',
                'session_name' => 'required',
                'selectedCourse' => 'required',
                'selectedspecialization' => 'required',
                'admission_type' => 'required',
                'fname' => 'required',
                'father_name' => 'required',
                'mother_name' => 'required',
                'dob' => 'required',
                'email' => 'required',
                'mob' => 'required',
                'address' => 'required',
                'pmigration' => 'required',
                'fee' => 'required',
                'exam_status' => 'required',
                'prj_status' => 'required',
                'visit_date' => 'required',
                'pass_back' => 'required',
                'aadhar_no' => [
                    'required',
                    // Ensure uniqueness of aadhar_no, session, and course together
                    Rule::unique('students')->where(function ($query) {
                        return $query->where('aadhar_no', $this->aadhar_no)
                            ->where('session', $this->session_name)
                            ->where('course_id', $this->selectedCourse);
                    }),
                ],
                'source' => 'required',
                'selectedassociate' => 'required_if:source,ASSOCIATE',
                'semester' => 'required',
                'documents.*' => 'file|mimes:jpeg,png,jpg,gif|max:1024',
            ]);
            // dd($validatedData);
            $lastId = Students::latest('id')->value('id');
            $newId = $lastId + 1;
            $student = new Students;
            $student->id = $newId;
            $student->university_id = $validatedData['university'];
            $student->associate = $validatedData['selectedassociate'];
            $student->source = $validatedData['source'];
            $student->name = $validatedData['fname'];
            $student->father_name = $validatedData['father_name'];
            $student->mother_name = $validatedData['mother_name'];
            $student->dob = $validatedData['dob'];
            $student->aadhar_no = $validatedData['aadhar_no'];
            $student->email_id = $validatedData['email'];
            $student->address = $validatedData['address'];
            $student->mob_no = $validatedData['mob'];
            $student->course_id = $validatedData['selectedCourse'];
            $student->spl = $validatedData['selectedspecialization'];
            $student->type = $validatedData['admission_type'];
            $student->session = $validatedData['session_name'];
            $student->previous_migration = $validatedData['pmigration'];
            $student->fee = $validatedData['fee'];
            $student->exam_status = $validatedData['exam_status'];
            $student->project_status = $validatedData['prj_status'];
            $student->uni_visit_date = $validatedData['visit_date'];
            $student->pass_back = $validatedData['pass_back'];
            $student->sem_year = $validatedData['semester'];

            if ($this->documents != null) {
                $documents = [];
                foreach ($this->documents as $file) {
                    $path = $file->store('documents');
                    $documents[] = storage_path('app/' . $path);
                }
                $pdf = PDF::loadView('documentpdf', compact('documents'));
                $pdfFileName = uniqid() . '.pdf';
                $tempPdfPath = 'temp/' . $pdfFileName;
                Storage::put($tempPdfPath, $pdf->output());
                $pdfPath = 'documentspdf/' . $pdfFileName;
                Storage::disk('public')->put($pdfPath, $pdf->output());
                $student->documents = $pdfPath;
            }
            $student->save();
            $this->resetForm();
        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            session()->flash('error', $errors[0]);
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
    private function resetForm()
    {
        $this->university = null;
        $this->session_name = null;
        $this->selectedCourse = null;
        $this->specialization = null;
        $this->admission_type = null;
        $this->fname = null;
        $this->lname = null;
        $this->father_name = null;
        $this->mother_name = null;
        $this->dob = null;
        $this->email = null;
        $this->mob = null;
        $this->address = null;
        $this->pmigration = null;
        $this->fee = null;
        $this->exam_status = null;
        $this->prj_status = null;
        $this->visit_date = null;
        $this->pass_back = null;
        $this->board = null;
        $this->source = null;
        $this->associate = null;
        $this->selectedassociate = null;
        $this->adhaar = null;
        $this->semester = null;
        $this->documents = null;
    }

    public function mount()
    {
        
        // $this->sessions = admission_session::all();
        $this->universities = University::all();
        $this->associate = User::where('usertype', 'associate')->get();
    }
    public function updatedUniversity($university){
        if(!is_null($university)){
            $this->sessions = admission_session::where('university_id', $university)->get();
            $this->course = Cousre::where('university_id', $university)->get();
            // dd($this->course);
        }
    }
    /* method to for dropdown */
    public function updatedSelectedCourse($selectedCourse)
    {
        if (!is_null($selectedCourse)) {
            $this->specialization = specializations::where('course_id', $selectedCourse)->get();
        }
    }
    public function render()
    {
        return view('livewire.add-student');
    }
}
