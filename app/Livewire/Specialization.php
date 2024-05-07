<?php

namespace App\Livewire;
use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Cousre;





class Specialization extends Component
{
    public $showAddForm = false;
    
    public $showEditForm=false;
    public $courses;
    public $course_name;
    public $specialization_name;
    public function mount(){
        $this->courses = Cousre::all();
    }

    public function toggleAddForm()
    {
           $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
    }
   
    
    public function save(){
        $validatedData = $this->validate([
            'specialization_name' => [
                'required',
                Rule::unique('specializations')->where(function ($query) {
                    return $query->where('course_id', $this->course_name);
                })
            ],
            'course_name' => 'required'
        ]);

        $specialization = new Specialization;
        $specialization->specialization_name = $this->specialization_name;
        $specialization->course_id = $this->course_name;
        $specialization->save();

        $this->reset(['specialization_name', 'course_name']); 
        $this->emit('specializationAdded'); 
        $this->showAddForm = false; 
    }
    
   

    public function render()
    {
        return view('livewire.specialization');
    }
}
