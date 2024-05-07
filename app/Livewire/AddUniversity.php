<?php

namespace App\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\University;

class AddUniversity extends Component
{
    #[Validate('required', message: 'Please provide University Name', translate: false)]
    public $university_name = '';
    #[Validate('required', message: 'Please provide University Code', translate: false)]
    public $university_code = '';

    public function save()
    {
        $validatedData = $this->validate([
            'university_name' => 'required|unique:universities',
            'university_code' => 'required|unique:universities',
        ], [
            'university_name.required' => 'The university name is required.',
            'university_name.min' => 'The university name must be at least 3 characters.',
            'university_name.unique' => 'The university name has already been taken.',
            'university_code.required' => 'The university code is required.',
            'university_code.min' => 'The university code must be at least 3 characters.',
            'university_code.unique' => 'The university code has already been taken.',
        ]);

        if (University::create($validatedData)) {
            session()->flash('status', 'Unversity created suucessfully');
        } else {
            session()->flash('status', 'University Not created');
        }

        $this->resetForm();
    }
    public function resetForm()
    {
        $this->university_name = '';
        $this->university_code = '';
    }

    public function render()
    {
        return view('livewire.add-university');
    }
}
