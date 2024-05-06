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
    public $programmes;
    public $sessions;
    public $courses;
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
    public $skills = [];
    public function addSkill($index)
    {
        // Insert an empty string at the specified index
        array_splice($this->skills, $index + 1, 0, '');
    }

    public function removeSkill($index)
    {
        // Remove the item at the specified index
        unset($this->skills[$index]);
        // Re-index the array
        $this->skills = array_values($this->skills);
    }
    // public $telephone;

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
