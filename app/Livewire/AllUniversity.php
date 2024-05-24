<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\University;

class AllUniversity extends Component
{

    public $university_id;
    public function delete($id)
    {

        $this->university_id = $id;
        University::find($this->university_id)->delete();


    }
    public function render()
    {
        $university = University::all();
        //$alluniversity = University::withTrashed()->get();
        
        return view('livewire.all-university', ['universities' => $university]);
    }
}
