<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\admission_session;
use App\Models\Programme;
use App\Models\Cousre;
use App\Models\University;
use Livewire\Attributes\Validate;

class AddStudent extends Component
{
    public $session_name;
    public $programme_id;
    public $course_id;
    #[Validate('required', message:'Please Enter the Programme Name',translate:false)]
    public $programmes;
    #[Validate('required', message:'Please Enter the Session',translate:false)]
    public $sessions;
    #[Validate('required', message:'Please Enter the Course',translate:false)]
    public $courses;
    #[Validate('required', message:'Please Enter the University',translate:false)]
    public $university;
   
    public $selectedProgramme=null;
    public $selectedCourseFee = null;
    #[Validate('required', message:'Please Enter the First Name',translate:false)]
    public $fname;
    #[Validate('required', message:'Please Enter the Last Name',translate:false)]
    public $lname;
    #[Validate('required', message:'Please Enter the Father Name',translate:false)]
    public $father_name;
    #[Validate('required', message:'Please Enter the Mother Name',translate:false)]
    public $mother_name;
    #[Validate('required', message:'Please Enter the Date of Birth',translate:false)]
    public $dob;
    #[Validate('required', message:'Please Enter the Email',translate:false)]
    public $email;
    #[Validate('required', message:'Please Enter the Mobile',translate:false)]
    public $mob;
    #[Validate('required', message:'Please Enter the full address',translate:false)]
    public $address;
    #[Validate('required', message:'Please Enter the City Name',translate:false)]
    public $city;
    #[Validate('required', message:'Please Enter the Pin code',translate:false)]
    public $pincode;
    #[Validate('required', message:'Please Enter the State ',translate:false)]
    public $state;
    #[Validate('required', message:'Please Enter the District',translate:false)]
    public $distt;
    #[Validate('required', message:'Please Enter the Academic Details',translate:false)]
    public $academic;
    #[Validate('required', message:'Please Enter the Subjects',translate:false)]
    public $subject;
    #[Validate('required', message:'Please Enter the Passing Year',translate:false)]
    public $passingyear;
    #[Validate('required', message:'Please Enter the Division',translate:false)]
    public $division;
    #[Validate('required', message:'Please Enter the Marks',translate:false)]
    public $marks;
    #[Validate('required', message:'Please Enter the Medium',translate:false)]
    public $medium;
    #[Validate('required', message:'Please Enter the Board Name',translate:false)]
    public $board;
   
    // public $telephone;
    public function addstudent(){

    }
    public function mount()
    {
        $this->programmes = Programme::all();
        $this->sessions = admission_session::all();
        $this->university = University::all();
        
    }
    public function updatedSelectedProgramme($selectedProgramme){
        $this->courses = Cousre::where('programmes_id', $selectedProgramme)->get();
    }
    // public function updatedSelectedCourseFee($selectedCourseFee){
    //     $this->selectedCourseFee = Cousre::find($selectedCourseFee);
       
    // }
   

    public function render()
    {
        
        return view('livewire.add-student');
    }
}
