<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\admission_session;
use App\Models\Programme;
use App\Models\Cousre;
use App\Models\University;

class AddStudent extends Component
{
    public $programmes;
    public $sessions;
    public $courses;
    public $university;
    public $selectedProgramme=null;
    public $selectedCourseFee = null;

    public function mount()
    {
        $this->programmes = Programme::all();
        $this->sessions = admission_session::all();
        $this->university = University::all();
        
    }
    public function updatedSelectedProgramme($selectedProgramme){
        $this->courses = Cousre::where('programmes_id', $selectedProgramme)->get();
    }
    public function updatedSelectedCourseFee($selectedCourseFee){
        $this->selectedCourseFee = Cousre::find($selectedCourseFee);
       
    }
   

    public function render()
    {
        
        return view('livewire.add-student');
    }
}
