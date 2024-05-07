<?php

namespace App\Livewire;

use App\Models\Cousre;
use App\Models\Programme;
use Livewire\Component;
use Livewire\Attributes\Validate;

class CoursesDetails extends Component
{
    public $showAddForm;
    public $c_id;
    public $showEditForm;
    #[Validate('required', message:'Please Enter the Course Name',translate:false)]
    public $course_name;
   

    public function toggleAddForm(){
        $this->showAddForm = ! $this->showAddForm ;
    }
    public function save(){
        
        $validateData = $this->validate([
            'course_name'=>'required|min:5|unique:cousres',
        ],[
            'course_name.required' => 'The Course name is required.',
            'course_name.min' => 'The Course name must be at least 3 characters.',
            'course_name.unique' => 'The Course is already exists.',          
        ]);
        
        $data = new Cousre;
        $data->course_name = $validateData['course_name'];
        $data->save();
        $this->course_name = '';
        $this->toggleAddForm();
        
    }
    public function delete($id){
        Cousre::find($id)->delete();
    }
    public $oldprograme;
    public $oldcourse;
    public $old_p_id;
    public function edit($id){
        $this->showEditForm = true;
        $old_course = Cousre::find($id);
        $this->c_id = $old_course->id;
        $this->oldcourse = $old_course->course_name;
        
      
    }
    public $programmes;
    public $u_programme;
    public function render()
    {
        
        $courses = Cousre::with('programmes')->get();
        return view('livewire.courses-details',['course'=>$courses]);
    }
}
