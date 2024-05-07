<?php

namespace App\Livewire;

use App\Models\Cousre;

use Livewire\Component;
use Livewire\Attributes\Validate;

class CoursesDetails extends Component
{
    public $showAddForm;
    public $c_id;
    public $showEditForm;
    #[Validate('required', message: 'Please Enter the Course Name', translate: false)]
    public $course_name;


    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
    }
    public function save()
    {

        $validateData = $this->validate([
            'course_name' => 'required|unique:cousres',
        ], [
            'course_name.required' => 'The Course name is required.',

            'course_name.unique' => 'The Course is already exists.',
        ]);

        $data = new Cousre;
        $data->course_name = $validateData['course_name'];
        $data->save();
        $this->course_name = '';
        $this->toggleAddForm();

    }
    public function delete($id)
    {
        Cousre::find($id)->delete();
    }
    public $oldcourse;

    public function edit($id)
    {
        $this->showEditForm = true;
        $old_course = Cousre::find($id);
        $this->c_id = $old_course->id;
        $this->course_name = $old_course->course_name;


    }
    public function update()
    {
        $validateData = $this->validate([
            'course_name' => 'required|unique:cousres',
        ], [
            'course_name.required' => 'The Course name is required.',

            'course_name.unique' => 'The Course is already exists.',
        ]);
        $old_course = Cousre::find($this->c_id);

        $old_course->course_name = $this->course_name;
        $old_course->update([
            'course_name' => $this->course_name
        ]);
        $this->reset(['course_name']);
        $this->showEditForm = false;

    }

    public function render()
    {
        $courses = Cousre::get();
        return view('livewire.courses-details', ['course' => $courses]);
    }
}
