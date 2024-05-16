<?php
namespace App\Livewire;
use App\Models\Students;
use App\Models\University;
use App\Models\Cousre;
use App\Models\Associate;
use App\Models\admission_session;
use Livewire\Component;
use App\Models\specializations;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule; 
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;

class Updatestudent extends Component
{
    use WithFileUploads;
    public $id;
    public $studentdata;
    public $university;
    public $uuniversity;
    public $sessions;
    public $cousre;
    public $selectedCourse;
    public $specialization;
    public $associate;
    public $selectedassociate;
    public $source = '';
    public $usession_name;
    public $uselectedCourse;
    public $uselectedspecialization;
    public $uadmission_type;
    public $usemester;
    public $usource;
    public $uassociate;
    public $fname;
    public $father_name;
    public $mother_name;
    public $dob;
    public $email;
    public $aadhar_no;
    public $mob;
    public $address;
    public $pmigration;
    public $fee;
    public $exam_status;
    public $prj_status;
    public $visit_date;
    public $pass_back;
    public $documents;
    public function mount($id)
    {
        $this->id = $id;
        $this->studentdata = Students::with('university', 'course', 'session', 'associate')->find($this->id);
        // dd($this->studentdata->spl);
        $this->uuniversity = $this->studentdata->university;
        $this->usession_name = $this->studentdata->session;
        $this->uselectedCourse = $this->studentdata->course;
        $this->specialization = specializations::where('course_id', $this->uselectedCourse)->get();
        $this->uselectedspecialization = $this->studentdata->spl;
        $this->uadmission_type = $this->studentdata->type;
        $this->usemester = $this->studentdata->sem_year;
        $this->usource = $this->studentdata->source;
        $this->uassociate = $this->studentdata->associate;
        $this->fname = $this->studentdata->name;
        $this->father_name = $this->studentdata->father_name;
        $this->mother_name = $this->studentdata->mother_name;
        $this->dob = $this->studentdata->dob;
        $this->email = $this->studentdata->email_id;
        $this->aadhar_no = $this->studentdata->aadhar_no;
        $this->mob = $this->studentdata->mob_no;
        $this->address = $this->studentdata->address;
        $this->pmigration = $this->studentdata->previous_migration;
        $this->fee = $this->studentdata->fee;
        $this->exam_status = $this->studentdata->exam_status;
        $this->prj_status = $this->studentdata->project_status;
        $this->visit_date = $this->studentdata->uni_visit_date;
        $this->pass_back = $this->studentdata->pass_back;
        $this->university = University::all();
        $this->cousre = Cousre::all();
        $this->sessions = admission_session::all();
        $this->associate = Associate::all();
    }
    public function updatestudent()
    {
        $validatedData = $this->validate([
            'uuniversity' => 'required',
            'usession_name' => 'required',
            'uselectedCourse' => 'required',
            'uselectedspecialization' => 'required',
            'uadmission_type' => 'required',
            'usemester' => 'required',
            'usource' => 'required',
            'uassociate' => 'required_if:usource,ASSOCIATE',
            'fname' => 'required|string|max:255',
            'father_name' => 'required|string|max:255',
            'mother_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'email' => 'required|email',
            'aadhar_no' => [
                'required',
                'numeric',
                'digits:12',
                Rule::unique('students')->where(function ($query) {
                    return $query->where('aadhar_no', $this->aadhar_no)
                                 ->where('session', $this->usession_name)
                                 ->where('course', $this->uselectedCourse);
                })->ignore($this->id),
            ],
            'mob' => 'required|numeric|digits:10',
            'address' => 'required|string',
            'pmigration' => 'required|date',
            'fee' => 'required|numeric',
            'exam_status' => 'required|string',
            'prj_status' => 'required|string',
            'visit_date' => 'required|date',
            'pass_back' => 'required|string',
            'documents.*' => 'file|mimes:jpeg,png,jpg,gif|max:1024',
        ]);
        //dd($validatedData);
        $student = Students::findOrFail($this->id);
        $student->university = $validatedData['uuniversity'];
        $student->associate = $validatedData['uassociate'];
        $student->source = $validatedData['usource'];
        $student->name = $validatedData['fname'];
        $student->father_name = $validatedData['father_name'];
        $student->mother_name = $validatedData['mother_name'];
        $student->dob = $validatedData['dob'];
        $student->aadhar_no = $validatedData['aadhar_no'];
        $student->email_id = $validatedData['email'];
        $student->address = $validatedData['address'];
        $student->mob_no = $validatedData['mob'];
        $student->course = $validatedData['uselectedCourse'];
        $student->spl = $validatedData['uselectedspecialization'];
        $student->type = $validatedData['uadmission_type'];
        $student->session = $validatedData['usession_name'];
        $student->previous_migration = $validatedData['pmigration'];
        $student->fee = $validatedData['fee'];
        $student->exam_status = $validatedData['exam_status'];
        $student->project_status = $validatedData['prj_status'];
        $student->uni_visit_date = $validatedData['visit_date'];
        $student->pass_back = $validatedData['pass_back'];
        $student->sem_year = $validatedData['usemester'];
        if ($this->documents != null) {
            $existingPdfPath = storage_path('app/public/' . $student->documents);
    
            // Initialize FPDI
            $pdf = new Fpdi();
            $pageCount = $pdf->setSourceFile($existingPdfPath);
    
            // Import all pages of the existing PDF
            for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                $templateId = $pdf->importPage($pageNo);
                $pdf->AddPage();
                $pdf->useTemplate($templateId);
            }
    
            // Add new images
            foreach ($this->documents as $file) {
                $imagePath = $file->store('documentspdf');
                $imageFullPath = storage_path('app/' . $imagePath);
    
                $pdf->AddPage();
                $pdf->Image($imageFullPath, 10, 10, 190, 0);
            }
    
            // Save the updated PDF
            $updatedPdfPath = 'documentspdf/' . uniqid() . '.pdf';
            $pdf->Output(storage_path('app/public/' . $updatedPdfPath), 'F');
    
            // Update the student record with the new PDF path
            $student->documents = $updatedPdfPath;
        }
        $student->save();
        return redirect()->route('all-student');
    }
    public function updatedUselectedCourse($selectedCourse)
    {
        if (!is_null($selectedCourse)) {
            $this->specialization = specializations::where('course_id', $selectedCourse)->get();
        }
    }
    public function render()
    {
        return view('livewire.updatestudent');
    }
}
