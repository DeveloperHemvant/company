<?php
namespace App\Livewire;

use App\Models\admission_session;
use Illuminate\Support\Facades\Storage;
use App\Models\Students;
use App\Models\University;
use App\Models\Cousre;
use Livewire\Component;
use App\Exports\ExportStudent;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Exports\SampleStudentsExport;
use Carbon\Carbon;

class Allstudents extends Component
{
    use WithPagination;

    use WithFileUploads;
    public $showDropdown = false;
    public $admissionSessions;
    public $uselectedSession;
    public $errorMessage;
    public $perPage = 10;
    public $importForm = false;
    public $search = '';
    public $u_search;
    public $studentdata;
    public $monthDifference;
    public $university;
    public $course;
    public $c_search;
    // public $st_id;
    public $c_id;
    public $hideform;
    public $uni_reg_no;
    public $upassword;
    public $showRegistrationForm = false;
    public $importData;
    public $student_id;
    public $sessions = [];
    public $session_name;
    public $fee;
    public $semester;
    public $id;
    public function import()
    {
        $this->importForm = true;
    }
    public function cancelimportform()
    {
        $this->importForm = false;
        $this->importData = '';
    }
    public function mount()
    {
        $this->university = University::all();
        $this->course = Cousre::all();
    }
    public function universitypassword($id)
    {
        $this->c_id = $id;
        $this->showRegistrationForm = true;
        $st_reg = Students::findOrFail($id);
        $this->uni_reg_no = $st_reg->uni_reg_no;
        $this->upassword = $st_reg->password;
    }
    public function update()
    {
        $validatedData = $this->validate([
            'uni_reg_no' => 'required',
            'upassword' => 'required'
        ]);
        $student = Students::findOrFail($this->c_id);
        $student->uni_reg_no = $validatedData['uni_reg_no'];
        $student->password = $validatedData['upassword'];
        $student->save();
        $this->uni_reg_no = '';
        $this->upassword = '';
        $this->toggleAddForm();
    }
    public function toggleAddForm()
    {
        $this->showRegistrationForm = false;
    }
    public $postIdToDelete;
    public function confirmDelete($postId)
    {
        $this->postIdToDelete = $postId;


        $this->dispatch('delete');
    }
    #[On('goOn-Delete')]
    public function delete()
    {
        $student = Students::find($this->postIdToDelete);
        $student->aadhar_no = $student->aadhar_no . '_DEL'.$student->id;
        // dd($student->aadhar_no);
        $student->save();
        $student->delete();
        $this->dispatch('delete');
    }
    //export the data////
    public function export_data()
    {
        $data = Students::with('university', 'course', 'session', 'specialization')->get()->toArray();
        // dd($data);
        return Excel::download(new ExportStudent($data), 'students.xlsx');
    }
    public function downloadSample()
    {
        return Excel::download(new SampleStudentsExport, 'sample.xlsx');

    }
    //Import the data//
    public function importexceldata()
    {
        try {
            $validatedData = $this->validate([
                'importData' => 'required|file|mimes:xlsx|max:10240',
            ], [
                'importData.mimes' => 'The :attribute must be an Excel file (xlsx).',
            ]);

            $fileName = time() . '_' . $this->importData->getClientOriginalName();
            Storage::disk('public')->putFileAs('uploads', $this->importData, $fileName);

            $import = new StudentsImport;
            Excel::import($import, Storage::disk('public')->path('uploads/' . $fileName));

            $successCount = $import->getSuccessCount();
            $failureCount = $import->getFailureCount();
            $errors = $import->getErrors();
            $skippedUniversities = $import->getSkippedUniversities();

            $skippedMessage = '';
            if (!empty($skippedUniversities)) {
                $skippedMessage = ' Skipped Universities: ' . json_encode($skippedUniversities);
            }

            if (!empty($errors)) {
                session()->flash('error', implode(', ', $errors) . $skippedMessage);
            } else {
                session()->flash('success', "{$successCount} records imported successfully, {$failureCount} records failed." . $skippedMessage);
            }

            $this->importForm = false;
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
    public function updatedPerPage()
    {
        $this->resetPage();
    }
    public function usemester($id)
    {
        $this->showDropdown = true;
        $student = Students::find($id);
        $this->id = $id;
        $this->admissionSessions = admission_session::where('university_id', $student->university_id)->get();
        // $this->monthDifference = '';

    }
    public function hide()
    {
        $this->showDropdown = false;
    }
    public function updatesem()
    {
        $student = Students::find($this->id);

        $validatedData = $this->validate([
            'uselectedSession' => 'required',
            'fee' => 'nullable|required|numeric',
            'semester' => 'required',
        ], [
            'uselectedSession.required' => 'The session name is required.',
            'fee.required' => 'The fee is required .',
            'fee.numeric' => 'The fee must be a valid number.',
            'semester.required' => 'The semester is required.',
        ]);
        $oldsessiondata = admission_session::find($student->session_id);
        $newsessiondata = admission_session::find($validatedData['uselectedSession']);
        $oldEndMonth = Carbon::createFromFormat('Y-m', $oldsessiondata->endmonth);
        $newStartMonth = Carbon::createFromFormat('Y-m', $newsessiondata->startmonth);
        ///compare the diffrence of months/////
        // $sessionendmonth = Carbon::createFromFormat('Y-m', $newsessiondata->endmonth);
        // $sessionstartmonth = Carbon::createFromFormat('Y-m', $newsessiondata->startmonth);
        // $monthDifference = $sessionstartmonth->diffInMonths($sessionendmonth);
        // if ($monthDifference >= 11) {
        //     $validatedData['semester']=$validatedData['semester']+1;
        //     // dd($validatedData['semester']);
        // }
        if ($oldEndMonth->gt($newStartMonth)) {
            $this->dispatch('exists', ['message' => 'Please Select the upcoming Session.']);
        } else {
            if ($validatedData['uselectedSession'] == $student->session_id || $validatedData['semester'] == $student->sem_year) {
                if ($validatedData['uselectedSession'] == $student->session_id) {
                    $this->dispatch('exists', ['message' => 'This student is already registered in this Session .']);
                }
                if ($validatedData['semester'] == $student->sem_year || $validatedData['semester'] < $student->sem_year) {
                    $this->dispatch('exists', ['message' => 'Semester must be greater then previos semester.']);
                }

            } else {
                $lastId = Students::withTrashed()->latest('id')->value('id');
                // dd($lastId);
                $newId = $lastId + 1;
                // dd($newId);
                $restudent = new Students();
                $restudent->fill([
                    'id' => $newId,
                    'university_id' => $student->university_id,
                    'user_id' => $student->user_id,
                    'associate' => $student->associate,
                    'source' => $student->source,
                    'name' => $student->name,
                    'father_name' => $student->father_name,
                    'mother_name' => $student->mother_name,
                    'dob' => $student->dob,
                    'aadhar_no' => $student->aadhar_no,
                    'email_id' => $student->email_id,
                    'address' => $student->address,
                    'mob_no' => $student->mob_no,
                    'course_id' => $student->course_id,
                    'specialization_id' => $student->specialization_id,
                    'type' => $student->type,
                    'session_id' => $validatedData['uselectedSession'],
                    'previous_migration' => $student->previous_migration,
                    'fee' => $validatedData['fee'],
                    'exam_status' => $student->exam_status,
                    'project_status' => $student->project_status,
                    'uni_visit_date' => $student->uni_visit_date,
                    'pass_back' => $student->pass_back,
                    'sem_year' => $validatedData['semester'],
                ]);
                $restudent->save();
                $this->showDropdown = false;
                $this->dispatch('semesterUpdated');
            }
            
        }



    }
    public function updatedUselectedSession($id)
    {
        $session_diff = admission_session::find($id);
        // dd($session_diff->endmonth);

        $startDate = Carbon::createFromFormat('Y-m', $session_diff->startmonth);
        $endDate = Carbon::createFromFormat('Y-m', $session_diff->endmonth);
        // $this->usemester = '';

        // Calculate the difference in months
        $this->monthDifference = $startDate->diffInMonths($endDate);
        //dd($this->monthDifference);
    }
    public function render()
    {
        $studentDatas = Students::with('university', 'course')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('father_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email_id', 'like', '%' . $this->search . '%');
            })->where('university_id', 'like', '%' . $this->u_search . '%')->where('course_id', 'like', '%' . $this->c_search . '%')->orderBy('id', 'desc')->paginate($this->perPage);
        return view('livewire.allstudents', ['studentDatas' => $studentDatas]);
    }
}
