<?php
namespace App\Livewire;

use App\Models\Students;
use App\Models\University;
use App\Models\Cousre;
use Livewire\Component;

class Allstudents extends Component
{
    public $search = '';
    public $u_search;
    public $studentdata;
    public $university;
    public $course;
    public $c_search;
    // public $st_id;
    public $c_id;
    public $hideform;
    public $uni_reg_no;
    public $upassword;
    public $showRegistrationForm = false;
    public function mount()
    {
        $this->university = University::all();
        $this->course = Cousre::all();
    }
    public function universitypassword($id)
    {
        $this->c_id = $id;
        $this->showRegistrationForm = true;
        $st_reg = Students::findOrFail($id);
        $this->uni_reg_no = $st_reg->uni_reg_no;
        $this->upassword = $st_reg->password;
    }
    public function update()
    {
        $validatedData = $this->validate([
            'uni_reg_no' => 'required',
            'upassword' => 'required'
        ]);
        $student = Students::findOrFail($this->c_id);
        $student->uni_reg_no = $validatedData['uni_reg_no'];
        $student->password = $validatedData['upassword'];
        $student->save();
        $this->uni_reg_no = '';
        $this->upassword = '';
        $this->toggleAddForm();
    }
    public function toggleAddForm()
    {
        $this->showRegistrationForm = false;
    }
    public function delete($id){
        $student = Students::find($id);
        $student->delete();
    }
    public function render()
    {
        $this->studentdata = Students::with('university', 'course')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('father_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email_id', 'like', '%' . $this->search . '%');
            })->where('university', 'like', '%' . $this->u_search . '%')->where('course', 'like', '%' . $this->c_search . '%')->get()->toArray();
        return view('livewire.allstudents');
    }
}
