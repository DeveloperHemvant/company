<?php

namespace App\Livewire;

use App\Models\students;
use Livewire\Component;
use App\Models\admission_session;
use App\Models\Cousre;
use App\Models\specializations;
use App\Models\University;
use Livewire\Attributes\Validate;

class AddStudent extends Component
{
    public $session_name;
    public $specialization;
    public $admission_type;
    #[Validate('required', message: 'Please Enter the Cousre Name', translate: false)]
    public $cousre;
    #[Validate('required', message: 'Please Enter the Session', translate: false)]
    public $sessions;
    #[Validate('required', message: 'Please Enter the Course', translate: false)]
    public $courses;
    #[Validate('required', message: 'Please Enter the University', translate: false)]
    public $universities;
    public $university;

    public $selectedCourse = null;

    #[Validate('required', message: 'Please Enter the First Name', translate: false)]
    public $fname;
    #[Validate('required', message: 'Please Enter the Last Name', translate: false)]
    public $lname;
    #[Validate('required', message: 'Please Enter the Father Name', translate: false)]
    public $father_name;
    #[Validate('required', message: 'Please Enter the Mother Name', translate: false)]
    public $mother_name;
    #[Validate('required', message: 'Please Enter the Date of Birth', translate: false)]
    public $dob;
    #[Validate('required', message: 'Please Enter the Email', translate: false)]
    public $email;
    #[Validate('required', message: 'Please Enter the Mobile', translate: false)]
    public $mob;
    #[Validate('required', message: 'Please Enter the full address', translate: false)]
    public $address;
    #[Validate('required', message: 'Please Enter the City Name', translate: false)]
    public $city;
    #[Validate('required', message: 'Please Enter the Pin code', translate: false)]
    public $pincode;
    #[Validate('required', message: 'Please Enter the State ', translate: false)]
    public $state;
    #[Validate('required', message: 'Please Enter the District', translate: false)]
    public $distt;
    #[Validate('required', message: 'Please Enter the Academic Details', translate: false)]
    public $academic;
    #[Validate('required', message: 'Please Enter the Subjects', translate: false)]
    public $subject;
    #[Validate('required', message: 'Please Enter the Passing Year', translate: false)]
    public $passingyear;
    #[Validate('required', message: 'Please Enter the Division', translate: false)]
    public $division;
    #[Validate('required', message: 'Please Enter the Marks', translate: false)]
    public $marks;
    #[Validate('required', message: 'Please Enter the Medium', translate: false)]
    public $medium;
    #[Validate('required', message: 'Please Enter the Board Name', translate: false)]
    public $board;
    public $adhaar;
    public function addstudent()
    {
        $validatedData = $this->validate([
            'university' => 'required',
            'session_name' => 'required',
            'selectedCourse' => 'required',
            'specialization' => 'required',
            'admission_type' => 'required',
            'fname' => 'required',
            'lname' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required',
            'email' => 'required',
            'mob' => 'required',
            'address' => 'required',
            'academic' => 'required',
            'subject' => 'required',
            'passingyear' => 'required',
            'division' => 'required',
            'marks' => 'required',
            'medium' => 'required',
            'board' => 'required',
            'adhaar'=>'required'

        ]);
        $student = new students;
        $student->UNIVERSITY = $validatedData['university'];
        $student->SESSION = $validatedData['session_name'];
        $student->COURSE = $validatedData['selectedCourse'];
        $student->SPL = $validatedData['specialization'];
        $student->TYPE = $validatedData['admission_type'];
        $student->NAME = $validatedData['fname'] . ' ' . $validatedData['lname'];
        $student->FATHER_NAME = $validatedData['father_name'];
        $student->MOTHER_NAME = $validatedData['mother_name'];
        $student->DOB = $validatedData['dob'];
        $student->EMAIL_ID = $validatedData['email'];
        $student->MOB_NO = $validatedData['mob'];
        $student->ADDRESS = $validatedData['address'];

        $student->SESSION = $validatedData['session_name'];
        $student->UNIVERSITY = $validatedData['university'];
        $student->SESSION = $validatedData['session_name'];
        $student->UNIVERSITY = $validatedData['university'];
        $student->SESSION = $validatedData['session_name'];
    }

    public function mount()
    {
        $this->cousre = Cousre::all();
        $this->sessions = admission_session::all();
        $this->universities = University::all();
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































// , [
//     'university.required' => 'The university name is required.',
//     'session_name.required' => 'The Session name is required.',
//     'selectedCourse.required' => 'The Course name is required.',
//     'specialization.required' => 'The Specialization name is required.',
//     'admission_type.required' => 'The Admission Type is required.',
//     'fname.required' => 'The First name is required.',
//     'lname.required' => 'The Last name is required.',
//     'father_name.required' => 'The Father Name name is required.',
//     'mother_name.required' => 'The Mother Name name is required.',
//     'dob.required' => 'The Date Of Birth name is required.',
//     'email.required' => 'The Email name is required.',
//     'mob.required' => 'The Mobile Number name is required.',
//     'address.required' => 'The address name is required.',
//     'subject.required' => 'The subject name is required.',
//     'passingyear.required' => 'The passing year name is required.',
//     'division.required' => 'The division name is required.',
//     'marks.required' => 'The marks name is required.',
//     'medium.required' => 'The medium name is required.',
//     'board.required' => 'The board name is required.',
// ]