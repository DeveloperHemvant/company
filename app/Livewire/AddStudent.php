<?php

namespace App\Livewire;

use App\Models\Students;
use Livewire\Component;
use App\Models\admission_session;
use App\Models\Cousre;
use App\Models\specializations;
use App\Models\University;
use App\Models\Associate;
use Livewire\Attributes\Validate;

class AddStudent extends Component
{
    public $session_name;
    public $specialization;
    public $admission_type;
    public $cousre;
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
    public function addstudent()
    {
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
            'adhaar'=>'required',
            'source'=>'required',
            'selectedassociate'=>'required',
            'semester'=>'required'
        ]);
        // dd($validatedData);
        $student = new Students;
        $student->UNIVERSITY = $validatedData['university'];
        $student->ASSOCIATE = $validatedData['selectedassociate'];
        $student->SOURCE = $validatedData['source'];
        $student->NAME = $validatedData['fname'];
        $student->FATHER_NAME = $validatedData['father_name'];
        $student->MOTHER_NAME = $validatedData['mother_name'];
        $student->DOB = $validatedData['dob'];
        $student->AADHAR_NO = $validatedData['adhaar'];
        $student->EMAIL_ID = $validatedData['email'];
        $student->ADDRESS = $validatedData['address'];
        $student->MOB_NO = $validatedData['mob'];
        $student->COURSE = $validatedData['selectedCourse'];
        $student->SPL = $validatedData['selectedspecialization'];
        $student->TYPE = $validatedData['admission_type'];
        $student->SESSION = $validatedData['session_name'];
        $student->PREVIOUS_MIGRATION = $validatedData['pmigration'];
        $student->FEE = $validatedData['fee'];
        $student->EXAM_STATUS = $validatedData['exam_status'];
        $student->PROJECT_STATUS = $validatedData['prj_status'];
        $student->UNI_VISIT_DATE = $validatedData['visit_date'];
        $student->PASS_BACK = $validatedData['pass_back'];
        $student->SEM_YEAR = $validatedData['semester'];
        $student->save();
        $this->resetForm();
        
        
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
    }

    public function mount()
    {
        $this->cousre = Cousre::all();
        $this->sessions = admission_session::all();
        $this->universities = University::all();
        $this->associate=Associate::all();
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
