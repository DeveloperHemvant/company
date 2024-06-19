<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\parentcontact;

class ParentForm extends Component
{
    public function delete($id){
        $data= parentcontact::find($id);
        $data->delete();
    }
    public function render()
    {
        $registeredUsers = parentcontact::all();
        return view('livewire.parent-form',['registeredUsers'=>$registeredUsers]);
    }
}
