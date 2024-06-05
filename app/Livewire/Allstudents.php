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
use Livewire\WithPagination;
use Livewire\Attributes\On;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Exports\SampleStudentsExport;


class Allstudents extends Component
{
    use WithPagination;

    use WithFileUploads;
    public $errorMessage;
    public $perPage=10;
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
    public $postIdToDelete;
    public function confirmDelete($postId)
    {
        $this->postIdToDelete = $postId;
        

        $this->dispatch('delete');
    }
    #[On('goOn-Delete')]
    public function delete()
    {
        $student = Students::find($this->postIdToDelete);
        $student->aadhar_no = $student->aadhar_no . '_DEL';
        $student->save();
        $student->delete();
    }
    //export the data////
    public function export_data()
    {
        $data = Students::with('university', 'course', 'session', 'specialization')->get()->toArray();
        // dd($data);
        return Excel::download(new ExportStudent($data), 'students.xlsx');
    }
    public function downloadSample()
    {
        return Excel::download(new SampleStudentsExport, 'sample.xlsx');

    }
    //Import the data//
    public function importexceldata()
    {
        try {
            $validatedData = $this->validate([
                'importData' => 'required|file|mimes:xlsx|max:10240',
            ], [
                'importData.mimes' => 'The :attribute must be an Excel file (xlsx).',
            ]);
    
            $fileName = time() . '_' . $this->importData->getClientOriginalName();
            Storage::disk('public')->putFileAs('uploads', $this->importData, $fileName);
    
            $import = new StudentsImport;
            Excel::import($import, Storage::disk('public')->path('uploads/' . $fileName));
    
            $successCount = $import->getSuccessCount();
            $failureCount = $import->getFailureCount();
            $errors = $import->getErrors();
            $skippedUniversities = $import->getSkippedUniversities();
    
            $skippedMessage = '';
            if (!empty($skippedUniversities)) {
                $skippedMessage = ' Skipped Universities: ' . json_encode($skippedUniversities);
            }
    
            if (!empty($errors)) {
                session()->flash('error', implode(', ', $errors) . $skippedMessage);
            } else {
                session()->flash('success', "{$successCount} records imported successfully, {$failureCount} records failed." . $skippedMessage);
            }
    
            $this->importForm = false;
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }
    public function updatedPerPage()
    {
        $this->resetPage(); // Reset the pagination page to 1 when changing perPage
    }
    public function render()
    {
        $studentDatas = Students::with('university', 'course')
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('father_name', 'like', '%' . $this->search . '%')
                    ->orWhere('email_id', 'like', '%' . $this->search . '%');
            })->where('university_id', 'like', '%' . $this->u_search . '%')->where('course_id', 'like', '%' . $this->c_search . '%')->orderBy('id', 'desc')->paginate($this->perPage);
        // dd(($studentData));
        
        return view('livewire.allstudents',['studentDatas'=>$studentDatas]);

    }
}
