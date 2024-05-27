<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use Livewire\Component;
use App\Models\Cousre;
use App\Models\specializations;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Specialization extends Component
{
    use WithPagination;
    public $showAddForm = false;
    public $showEditForm = false;
    public $courses;
    public $cousre_id;
    public $specialization_name;
    public $u_specialization_name;
    public $special_data;
    public $postIdToDelete;
    public function confirmDelete($postId)
    {
        $this->postIdToDelete = $postId;
        // dd($this->postIdToDelete);

        $this->dispatch('delete');
    }
    #[On('goOn-Delete')]
    public function delete()
    {
        $data = specializations::with('students')->find($this->postIdToDelete);
        if ($data->students->count() > 0) {

            $this->dispatch('alert', [
                'type' => 'warning',
                'title' => 'Warning',
                'position' => 'center',
                'text' => 'Please delete all the related data regarding this Specialization first.'
            ]);
        } else {
            $data->delete();
            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Success',
                'position' => 'center',
                'text' => 'Specialization deleted successfully.'
            ]);
            $this->refreshData();
        }
    }
    public function mount()
    {
        $this->courses = Cousre::all();
        $this->refreshData();
    }
    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->specialization_name = '';
        $this->cousre_id = '';
        $this->showEditForm = false;
    }
    public function save()
    {
        $validatedData = $this->validate([
            'specialization_name' => [
                'required',
                Rule::unique('specializations')->where(function ($query) {
                    return $query->where('cousre_id', $this->cousre_id);
                })
            ],
            'cousre_id' => 'required'
        ]);
        $data = new specializations();
        $data->specialization_name = $this->specialization_name;
        $data->cousre_id = $this->cousre_id;
        $data->save();       
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
                    return $query->where('cousre_id', $this->course_name);
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
    public function refreshData(): void
    {
        $this->special_data = specializations::with('cousre')->get();
    }

    public function render()
    {
        return view('livewire.specialization');
    }
}
