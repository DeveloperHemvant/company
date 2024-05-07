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
        $this->special_data = specializations::with('cousre')->get();

    }

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->reset(['specialization_name', 'course_name']);
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

        $specialization = new specializations;
        $specialization->specialization_name = $this->specialization_name;
        $specialization->course_id = $this->course_name;
        $specialization->save();

        // $this->reset(['specialization_name', 'course_name']);
        $this->specialization_name = '';
        $this->course_name = '';
        // $this->emit('specializationAdded'); 
        $this->showAddForm = false;
    }
    public $s_id;
    public $c_id;
    public $u_course_name;
    public function edit($id)
    {
        $this->showEditForm = true;
        $this->s_id = $id;
        $special_data = specializations::find($id);
        // dd($u_specialization_name);
        $this->u_specialization_name = $special_data->specialization_name;

        $this->c_id = $special_data->course_id;
    }
    public function update()
    {
        // dd('hello');
        $specializationId = $this->s_id;
        $data = specializations::find($specializationId);
        if ($data->id != $specializationId) {
            $validatedData = $this->validate([
                'u_specialization_name' => [
                    'required',
                    Rule::unique('specializations', 'specialization_name')->where(function ($query) {
                        return $query->where('course_id', $this->c_id);
                    })
                ],

                'u_course_name' => 'required:specializations,course_name'
            ]);
        }
        $data->where('id', $specializationId)->update([
            'specialization_name' => $this->u_specialization_name,
            'course_id' => $this->u_course_name
        ]);
        $this->showEditForm = false;


    }
    public function render()
    {
        return view('livewire.specialization');
    }
}
