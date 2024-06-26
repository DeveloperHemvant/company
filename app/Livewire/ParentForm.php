<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\parentcontact;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ParentFormDataExport;
class ParentForm extends Component
{
    public $search = '';
    public function delete($id){
        $data= parentcontact::find($id);
        $data->delete();
    }
    public function export(){
        $exportdata = parentcontact::where('parent_full_name','like','%'.$this->search.'%')->where('parent_email','like','%'.$this->search.'%')
        ->where('parent_mobile','like','%'.$this->search.'%')->where('student_name','like','%'.$this->search.'%')->get();
        return Excel::download(new ParentFormDataExport($exportdata), 'parentformdata.xlsx');     
    }
    public function render()
    {
        $registeredUsers = parentcontact::where('parent_full_name','like','%'.$this->search.'%')->where('parent_email','like','%'.$this->search.'%')
        ->where('parent_mobile','like','%'.$this->search.'%')->where('student_name','like','%'.$this->search.'%')->get();
        return view('livewire.parent-form',['registeredUsers'=>$registeredUsers]);
    }
}
