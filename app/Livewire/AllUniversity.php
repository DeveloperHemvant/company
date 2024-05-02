<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\University;

class AllUniversity extends Component
{

    public $university_id;
    public function delete($id){
        
            $this->university_id = $id;
            University::find($this->university_id)->delete();
            
        
    }
    // public function edit($id){
        
    //         $this->university_id = $id;
    //     return redirect('/edit-university', ['id' => $this->university_id]);
            
        
    // }
    public function render()
    {
        $university = University::all();
        return view('livewire.all-university',['universities'=>$university]);
    }
}
