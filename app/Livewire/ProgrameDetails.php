<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use App\Models\Programme;
use Livewire\Component;

class ProgrameDetails extends Component
{
    public $showAddForm = false;
    #[Validate('required', message: 'Please provide Programe Name', translate: false)]
    public $programme_name;
    #[Validate('required', message: 'Please provide Programe Name', translate: false)]
    public $oprogramme_name;

    public $programme_id;
    public $showEditForm = false;

    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'programme_name' => 'required|unique:programmes',
        ], [
            'programme_name.required' => 'The university name is required.',
            // 'programme_name.min' => 'The university name must be at least 3 characters.',
            'programme_name.unique' => 'The programme is already exists.',
        ]);
        $programmeName = $this->programme_name;
        $programme = new Programme;
        $programme->programme_name = $programmeName;
        $programme->save();
        $this->programme_name = '';
        $this->showAddForm = false;
    }
    public function edit($id)
    {

        $ooprogramme = Programme::find($id);
        $this->programme_id = $id;
        $this->oprogramme_name = $ooprogramme->programme_name;
        $this->showAddForm = false;
        $this->showEditForm = true;

    }
    public function update()
    {
        $validatedData = $this->validate([
            'oprogramme_name' => 'required|min:3|unique:programmes,programme_name',
        ], [
            'oprogramme_name.required' => 'The programme name is required.',

            'oprogramme_name.unique' => 'The programme is already exists.',
        ]);
        $updatedprograme = $this->oprogramme_name;
        $programme = Programme::find($this->programme_id);
        if ($programme) {
            $programme->update([
                'programme_name' => $this->oprogramme_name,
            ]);
        }
        $this->showEditForm = false;
        $this->oprogramme_name = '';
    }
    public function delete($id)
    {
        Programme::find($id)->delete();
    }
    public function render()
    {
        $allprogramme = Programme::all();
        return view('livewire.programe-details', ['proggrammes' => $allprogramme]);
    }
}
