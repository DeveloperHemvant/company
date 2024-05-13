<?php
namespace App\Livewire;

use App\Models\University;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Redirect;
class EditUniversity extends Component
{
    public $university;
    public $id;
    #[Validate('required', message: 'Please provide University Name', translate: false)]
    public $university_name = '';
    #[Validate('required', message: 'Please provide University Code', translate: false)]
    public $university_code = '';
    public function mount($id)
    {
        $this->id = $id;
        $this->university = University::find($id);
        $this->university_name = $this->university->university_name;
        $this->university_code = $this->university->university_code;
    }
    public function update()
    {
        $validatedData = $this->validate([
            'university_name' => 'required|min:3|unique:universities,university_name,' . $this->id,
            'university_code' => 'required|min:3|unique:universities,university_code,' . $this->id,
        ], [
            'university_name.required' => 'The university name is required.',
            'university_name.min' => 'The university name must be at least 3 characters.',
            'university_name.unique' => 'The university name has already been taken.',
            'university_code.required' => 'The university code is required.',
            'university_code.min' => 'The university code must be at least 3 characters.',
            'university_code.unique' => 'The university code has already been taken.',
        ]);
        $this->university->update([
            'university_name' => $this->university_name,
            'university_code' => $this->university_code,
        ]);
        session()->flash('status', 'University updated successfully.');
        return Redirect::route('all-university');
    }
    public function render()
    {
        return view('livewire.edit-university', ['university' => $this->university]);
    }
}