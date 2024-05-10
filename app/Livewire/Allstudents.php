<?php

namespace App\Livewire;

use App\Models\students;
use App\Models\University;
use App\Models\Cousre;
use Livewire\Component;
use Livewire\WithPagination;

class Allstudents extends Component
{
    public $search = '';
    public $u_search;
    public $studentdata;
    public $university;
    public $course;
    public $c_search;
    public $st_id;
    protected $listners = ['deleteConfirmed'];
    public function confirmDelete($id)
    {
        $this->st_id = $id;
        $this->dispatch('swal:confirm-delete');
    }
    public function deleteConfirmed()
    {
        dd($this->st_id);
        // Perform deletion logic here
        // For example, if you're deleting an item from a database, you might use Eloquent like so:
        // YourModel::destroy($id);
        // Then, you might emit an event to notify the front end that the deletion was successful
        // $this->emit('itemDeleted', $id);
    }

    function mount()
    {

        //dd($this->studentdata);
        $this->university = University::all();
        $this->course = Cousre::all();
    }
    public function delete()
    {
        dd('deleted');
    }
    public function render()
    {
        $this->studentdata = students::with('university', 'associate', 'course', 'session')
            ->where(function ($query) {
                $query->where('NAME', 'like', '%' . $this->search . '%')
                    ->orWhere('FATHER_NAME', 'like', '%' . $this->search . '%')
                    ->orWhere('EMAIL_ID', 'like', '%' . $this->search . '%');
            })
            ->where('UNIVERSITY', 'like', '%' . $this->u_search . '%')->where('COURSE', 'like', '%' . $this->c_search . '%')
            ->get();

        return view('livewire.allstudents');
    }
}
