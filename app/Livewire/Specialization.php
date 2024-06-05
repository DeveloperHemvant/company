<?php

namespace App\Livewire;

use App\Models\University;
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
    public $cousre;
    public $university;
    public $selectedUniversity;
    public $selecteduniversity;
    public $course_id;
    
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
        $this->university = University::all();
        $this->refreshData();
    }
    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->specialization_name = '';
        $this->cousre_id = '';
        $this->showEditForm = false;
    }
    public function updatedSelectedUniversity($selectedUniversity)
    {
       
        if (!is_null($selectedUniversity)) {
            $this->cousre = Cousre::where('university_id', $selectedUniversity)->get();
            $this->course_id = '';
        }
    }
    public function save()
    {
        // dd($this->course_id);
        $validatedData = $this->validate([
            'specialization_name' => [
                'required',
                Rule::unique('specializations')->where(function ($query) {
                    return $query->where('university_id', $this->selecteduniversity)
                                 ->where('cousre_id', $this->course_id); 
                })
            ],
            'course_id' => 'required',
            'selecteduniversity'=>'required'
        ]);
        $data = new specializations();
        $data->specialization_name = $this->specialization_name;
        $data->cousre_id = $this->course_id;
        $data->university_id = $this->selecteduniversity;
        $data->save();
    
        $this->refreshData();
        $this->toggleAddForm();
    }
    public $s_id;
    public $c_id;
    public function edit($id): void
    {
        $this->showEditForm = true;
        $this->showAddForm = false;

        $specialization = specializations::find($id);
        // dd($specialization);
        $this->s_id = $id;
        $this->specialization_name = $specialization->specialization_name;
        $this->course_id = $specialization->cousre_id;
        // dd($this->course_id);
        $this->cousre = Cousre::where('university_id', $specialization->university_id)->get();
        $this->selectedUniversity = $specialization->university_id;

    }
    public function update(): void
    {
        $validatedData = $this->validate([
            'specialization_name' => [
                'required',
                Rule::unique('specializations', 'specialization_name')->where(function ($query) {
                    return $query->where('university_id', $this->selectedUniversity)
                    ->where('cousre_id', $this->course_id); 
                })->ignore($this->s_id),
            ],
            'course_id' => 'required',
            'selectedUniversity'=>'required'
            
        ]);
        // dd($validatedData);
        $specialization = specializations::find($this->s_id);
        // $specialization->update([
        //     'specialization_name' => $this->specialization_name,
        //     'cousre_id' => $this->course_id,
        //     'university_id' => $this->selectedUniversity
        // ]);
        // dd($specialization->cousre_id);
        $specialization->specialization_name = $validatedData['specialization_name'];
        $specialization->cousre_id = $validatedData['course_id'];
        $specialization->university_id = $validatedData['selectedUniversity'];
        $specialization->save();

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
