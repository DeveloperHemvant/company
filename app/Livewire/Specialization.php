<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Cousre;
use App\Models\specializations;

class Specialization extends Component
{
    public $showAddForm = false;
    public $showEditForm = false;
    public $courses;
    public $course_name;
    public $specialization_name;
    public $u_specialization_name;
    public $special_data;

    public function mount()
    {
        $this->courses = Cousre::all();
        $this->refreshData();
    }

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'specialization_name' => [
                'required',
                Rule::unique('specializations')->where(function ($query) {
                    return $query->where('course_id', $this->course_name);
                })
            ],
            'course_name' => 'required'
        ]);

        specializations::create([
            'specialization_name' => $this->specialization_name,
            'course_id' => $this->course_name
        ]);

        $this->refreshData();
        $this->toggleAddForm();
    }
    public $s_id;
    public $c_id;
    public function edit($id)
    {
        $this->showEditForm = true;
        $specialization = specializations::find($id);
        $this->s_id = $id;
        $this->u_specialization_name = $specialization->specialization_name;
        $this->u_course_name = $specialization->course_id;
        
    }

    public function update()
    {
        $validatedData = $this->validate([
            'u_specialization_name' => [
                'required',
                Rule::unique('specializations', 'specialization_name')->where(function ($query) {
                    return $query->where('course_id', $this->u_course_name);
                })->ignore($this->s_id),
            ],
            'u_course_name' => 'required'
        ]);

        $specialization = specializations::find($this->s_id);
        $specialization->update([
            'specialization_name' => $this->u_specialization_name,
            'course_id' => $this->u_course_name
        ]);

        $this->refreshData();
        $this->showEditForm = false;
    }

    public function refreshData()
    {
        $this->special_data = specializations::with('cousre')->get();
    }

    public function render()
    {
        return view('livewire.specialization');
    }
}
