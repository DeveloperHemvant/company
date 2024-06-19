<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use App\Models\parentcontact;
class Form extends Component
{
    public $parent_full_name;
    public $parent_email;
    public $parent_mobile;
    public $student_name;
    public $has_laptop_desktop;

   
    public function submit()
    {
        $validatedData=$this->validate([
            'parent_full_name' => 'required|string|max:255',
            'parent_email' => 'required|email|max:255',
            'parent_mobile' => 'required|digits:10',
            'student_name' => 'required|string|max:255',
            'has_laptop_desktop' => 'required',
        ]);
        // dd($validatedData['parent_full_name']);
        parentcontact::create([
            'parent_full_name' => $validatedData['parent_full_name'],
            'parent_email' => $validatedData['parent_email'],
            'parent_mobile' => $validatedData['parent_mobile'],
            'student_name' => $validatedData['student_name'],
            'has_laptop_desktop' => $validatedData['has_laptop_desktop'],
        ]);

        session()->flash('message', 'Booking successfully created.');

        $this->reset();
    }
    public function render()
    {
        return view('livewire.frontend.form');
    }
}
