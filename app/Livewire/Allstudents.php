<?php

namespace App\Livewire;

use App\Models\students;
use App\Models\University;
use Livewire\Component;

class Allstudents extends Component
{
    public $studentdata;
    public $university;
    function mount(){
        $this->studentdata = students::with('university')->with('associate')->with('course')->with('session')->get();
        $this->university = University::all();
    }
    public function render()
    {
        return view('livewire.allstudents');
    }
}
