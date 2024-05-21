<?php

namespace App\Livewire;
use Illuminate\Validation\Rule; 

use App\Models\Cousre;
use App\Models\University;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

class CoursesDetails extends Component
{
    use WithPagination;

    public $showAddForm = false;
    public $c_id;
    public $showEditForm=false;
    #[Validate('required', message: 'Please Enter the Course Name', translate: false)]
    public $course_name;
    public $university_id;
    public $course_type;
    public $duration;

    // public function mount(){
    //     $this->university_id = University::all();
    // }

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
    }
    public function save()
    {

        $validateData = $this->validate([
            'course_name' => 'required|unique:cousres,course_name,NULL,id,university_id,' . $this->university_id . ',course_type,' . $this->course_type,
            'university_id' => 'required',
            'course_type' => 'required',
            'duration' => 'required',
        ], [
            'course_name.required' => 'The Course name is required.',
            'course_name.unique' => 'The Course already exists for this university and course type.',
            'university_id.required' => 'The university name is required.',
            'course_type.required' => 'The Course Type is required.',
            'duration.required' => 'The Duration name is required.',
        ]);
        
        // dd($validateData);
        $data = new Cousre;
        $data->course_name = $validateData['course_name'];
        $data->university_id = $validateData['university_id'];
        $data->course_type = $validateData['course_type'];
        $data->duration = $validateData['duration'];
        $data->save();
        $this->course_name = '';
        $this->university_id = '';
        $this->course_type = '';
        $this->duration = '';
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
        $old_course = Cousre::with('university')->find($id);
        // dd($old_course);
        $this->c_id = $old_course->id;
        $this->course_name = $old_course->course_name;
        $this->university_id = $old_course->university_id;
        $this->course_type = $old_course->course_type;
        $this->duration = $old_course->duration;


    }
    public function update()
    {
        $validatedData = $this->validate([
            'course_name' => [
                'required',
                Rule::unique('cousres', 'course_name')
                    ->ignore($this->c_id)
                    ->where(function ($query) {
                        return $query->where('university_id', $this->university_id)
                                     ->where('course_type', $this->course_type);
                    })
            ],
            'university_id' => 'required',
            'course_type' => 'required',
            'duration' => 'required',
        ], [
            'course_name.required' => 'The Course name is required.',
            'course_name.unique' => 'The Course already exists for this university and course type.',
            'university_id.required' => 'The university name is required.',
            'course_type.required' => 'The Course Type is required.',
            'duration.required' => 'The Duration name is required.',
        ]);
        // dd($validateData);
        $old_course = Cousre::find($this->c_id);

        if ($old_course) {
            $old_course->course_name = $validatedData['course_name'];
            $old_course->university_id = $validatedData['university_id'];
            $old_course->course_type = $validatedData['course_type'];
            $old_course->duration = $validatedData['duration'];
            $old_course->save();
        
            // Clear input fields and hide the edit form
            $this->reset(['course_name', 'university_id', 'course_type', 'duration', 'showEditForm']);
        }
    
        $this->course_name = '';
        $this->university_id = '';
        $this->course_type = '';
        $this->duration = '';
        $this->showEditForm = false;

    }

    public function render()
    {
        $courses = Cousre::with('university')->paginate(10);
        // dd($courses);
        $universities = University::all();
        return view('livewire.courses-details', ['courses' => $courses, 'universities' => $universities]);
    }
}
