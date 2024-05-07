<?php

namespace App\Livewire;

use App\Models\Associate;
use Livewire\Component;
use Livewire\Attributes\Validate;

class AssociateDetails extends Component
{
    public $showAddForm = false;
    public function toggleAddForm()
    {
        $associate_name = '';
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = !$this->showEditForm;
    }

    #[Validate('required', message: 'Please provide University Name', translate: false)]
    public $associate_name = '';
    public $updateassociate_name = '';
    public $showEditForm = false;
    public $associate_id;
    public function edit($id)
    {
        $associate = Associate::findOrFail($id);
        $this->associate_id = $associate->id;
        $this->updateassociate_name = $associate->associate_name;
        $this->showAddForm = false;
        $this->showEditForm = true;
    }
    public function delete($id)
    {
        $associate = Associate::find($id)->delete();
    }
    public function update()
    {
        $validatedData = $this->validate([
            'updateassociate_name' => 'required|min:3|unique:associates,associate_name,',
        ], [
            'updateassociate_name.required' => 'The associate name is required.',
            'updateassociate_name.min' => 'The associate name must be at least 3 characters.',
            'updateassociate_name.unique' => 'The associate name has already been taken.',
        ]);

        $associate = Associate::find($this->associate_id);
        if ($associate) {
            $associate->update([
                'associate_name' => $validatedData['updateassociate_name'],
            ]);
            session()->flash('status', 'Associate updated successfully');
        } else {
            session()->flash('status', 'Failed to update associate');
        }

        $this->showEditForm = false;
    }
    public function save()
    {
        $validatedData = $this->validate([
            'associate_name' => 'required|min:3|unique:associates,associate_name,'
        ], [
            'associate_name.required' => 'The associate name is required.',
            'associate_name.min' => 'The associate name must be at least 3 characters.',
            'associate_name.unique' => 'The associate name has already been taken.',
        ]);

        if (Associate::create($validatedData)) {
            session()->flash('status', 'Associate created suucessfully');
        } else {
            session()->flash('status', 'Associate Not created');
        }

        $this->resetForm();
    }

    private function resetForm()
    {
        $this->associate_name = '';
    }
    public function render()
    {
        $data = Associate::all();
        return view('livewire.associate-details', ['data' => $data]);
    }
}
