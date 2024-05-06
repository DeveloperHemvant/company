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
    #[Validate('required', message:'Please select the Programme ',translate:false)]
    public $programme_id;
    #[Validate('required', message:'Please select the Addmission Fee ',translate:false)]
    public $admission_fee;
    #[Validate('required', message:'Please select the Exam Fee ',translate:false)]
    public $exam_fee;
    #[Validate('required', message:'Please select the Late Fee ',translate:false)]
    public $late_fee;

    public function toggleAddForm(){
        $this->showAddForm = ! $this->showAddForm ;
    }
    public function save(){
        $validateData = $this->validate([
            'course_name'=>'required|min:5|unique:cousres',
            'programme_id'=>'required',
            'admission_fee'=>'required|numeric',
            'exam_fee'=>'required|numeric',
            'late_fee'=>'required|numeric'
        ],[
            'course_name.required' => 'The Course name is required.',
            'course_name.min' => 'The Course name must be at least 3 characters.',
            'course_name.unique' => 'The Course is already exists.',
            'programme_id.required' => 'The Programme name is required.',
            'admission_fee.required' => 'The Admission fee is required.',
            'admission_fee.numeric' => 'The Admission fee must be a number.',
            'exam_fee.required' => 'The Exam fee is required.',
            'exam_fee.numeric' => 'The Exam fee must be a number.',
            'late_fee.required' => 'The Late fee is required.',
            'late_fee.numeric' => 'The Late fee must be a number.',            
        ]);
        $course = new Cousre;
        $course->course_name = $this->course_name;
        $course->	programmes_id = $this->programme_id;
        $course->admission_fee = $this->admission_fee;
        $course->exam_fee = $this->exam_fee;
        $course->late_fee = $this->late_fee;

        $course->save();
        $this->programme_id = '';
        $this->course_name = '';
        $this->showAddForm = false;
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
        $this->old_p_id = $old_course->programmes_id;
        $this->oldprograme = $old_course->programmes->programme_name;
        $this->programmes=Programme::get();
    }
    public $programmes;
    public $u_programme;
    public function render()
    {
        $programmes = Programme::get();
        $this->programmes=$programmes;
        $courses = Cousre::with('programmes')->get();
        return view('livewire.courses-details',['programmes'=> $programmes,'course'=>$courses]);
    }
}
