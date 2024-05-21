<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Cousre;
use App\Models\specializations;
use Livewire\WithPagination;

class Specialization extends Component
{
    use WithPagination;
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
        $this->specialization_name = '';
        $this->course_name = '';
        $this->showEditForm = false;
    }

    public function save(): void
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
    public function edit($id): void
    {
        $this->showEditForm = true;
        $specialization = specializations::find($id);
        $this->s_id = $id;
        $this->specialization_name = $specialization->specialization_name;
        $this->course_name = $specialization->course_id;

    }

    public function update(): void
    {
        $validatedData = $this->validate([
            'specialization_name' => [
                'required',
                Rule::unique('specializations', 'specialization_name')->where(function ($query) {
                    return $query->where('course_id', $this->course_name);
                })->ignore($this->s_id),
            ],
            'course_name' => 'required'
        ]);

        $specialization = specializations::find($this->s_id);
        $specialization->update([
            'specialization_name' => $this->specialization_name,
            'course_id' => $this->course_name
        ]);

        $this->refreshData();
        $this->showEditForm = false;
    }
    public function delete($id):void
    {
        specializations::find($id)->delete();
        $this->refreshData();
    }
    public function refreshData(): void
    {
        $this->special_data = specializations::with('cousre')->get();
    }

    public function render()
    {
        return view('livewire.specialization');
    }
}
