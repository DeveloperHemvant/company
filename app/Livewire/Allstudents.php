<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\Students;
use App\Models\University;
use App\Models\Cousre;
use Livewire\Component;
use App\Exports\ExportStudent;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentsImport;

class Allstudents extends Component
{
    use WithFileUploads;
    public $importForm = false;
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
    public $importData;
    public function import()
    {
        $this->importForm = true;
    }
    public function cancelimportform()
    {

        $this->importForm = false;
        $this->importData = '';
    }

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

    public function delete($id)
    {
        $student = Students::find($id);
        $student->delete();
    }
    //export the data////

    public function export_data()
    {

        $data = Students::with('university', 'course', 'session', 'associate')->get()->toArray();
        // dd($data);

        return Excel::download(new ExportStudent($data), 'students.xlsx');
    }
    public function importexceldata()
    {
        $validatedData = $this->validate([
            'importData' => 'required|file|mimes:xlsx|max:10240',
        ], [
            'importData.mimes' => 'The :attribute must be an Excel file (xlsx).',
        ]);
        $fileName = time() . '_' . $this->importData->getClientOriginalName();
        Storage::disk('public')->putFileAs('uploads', $this->importData, $fileName);

        Excel::import(new StudentsImport, Storage::disk('public')->path('uploads/' . $fileName));

        
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
