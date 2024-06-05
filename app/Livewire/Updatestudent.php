<?php
namespace App\Livewire;

use App\Models\Students;
use App\Models\University;
use App\Models\Cousre;
use App\Models\User;
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
    public $createNewPdf;
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
    public $files = [];

    public function addFile()
    {
        $this->files[] = ['file' => null];
    }

    public function removeFile($index)
    {
        unset($this->files[$index]);
        $this->files = array_values($this->files); // reindex array
    }
    public function mount($id)
    {
        $this->id = $id;
        $this->studentdata = Students::with('university', 'course', 'session', 'associate','specialization')->find($this->id);
        // dd($this->studentdata);
        $this->uuniversity = $this->studentdata->university_id;
        $this->usession_name = $this->studentdata->session_id;
        $this->uselectedCourse = $this->studentdata->course_id;
        // dd($this->usession_name);
        $this->specialization = specializations::where('cousre_id', $this->uselectedCourse)->get();
        $this->uselectedspecialization = $this->studentdata->specialization_id;
        
        $this->uadmission_type = $this->studentdata->type;
        // dd($this->uadmission_type);
        $this->usemester = $this->studentdata->sem_year;
        $this->usource = $this->studentdata->source;
        $this->uassociate = $this->studentdata->user_id;
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
        $this->cousre = Cousre::where('university_id', $this->studentdata->university_id)->get();
        $this->sessions = admission_session::where('university_id', $this->studentdata->university_id)->get();
        // $this->usession_name = admission_session::where('id', $this->studentdata->session_id)->get()->value('name');
        $this->associate = User::where('usertype', 'associate')->get();
        $this->files[] = ['file' => null];

        // dd($this->associate);
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
                        ->where('session_id', $this->usession_name)
                        ->where('course_id', $this->uselectedCourse);
                })->ignore($this->id),
            ],
            'mob' => 'required|numeric|digits:10',
            'address' => 'required|string',
            'pmigration' => 'nullable|required_if:pmigration,null|date',
            'fee' => 'nullable|required_if:fee,null|numeric',
            'exam_status' => 'nullable|required_if:exam_status,null|string',
            'prj_status' =>'nullable|required_if:prj_status,null|string',
            'visit_date' =>'nullable|required_if:visit_date,null|date', 
            'pass_back' =>'nullable|required_if:pass_back,null|string', 
            'files.*.file' => 'file|mimes:jpeg,png,jpg|max:10240',
        ]);
        // dd($validatedData);
        $student = Students::findOrFail($this->id);
        $student->university_id = $validatedData['uuniversity'];
        // $student->associate = $validatedData['uassociate'];
        $student->user_id = $validatedData['uassociate'];
        $student->associate = User::where(['id'=>$validatedData['uassociate']])->pluck('name')->first();
        $student->source = $validatedData['usource'];
        $student->name = $validatedData['fname'];
        $student->father_name = $validatedData['father_name'];
        $student->mother_name = $validatedData['mother_name'];
        $student->dob = $validatedData['dob'];
        $student->aadhar_no = $validatedData['aadhar_no'];
        $student->email_id = $validatedData['email'];
        $student->address = $validatedData['address'];
        $student->mob_no = $validatedData['mob'];
        $student->course_id = $validatedData['uselectedCourse'];
        $student->specialization_id = $validatedData['uselectedspecialization'];
        $student->type = $validatedData['uadmission_type'];
        $student->session_id = $validatedData['usession_name'];
        $student->previous_migration = $validatedData['pmigration'];
        $student->fee = $validatedData['fee'];
        $student->exam_status = $validatedData['exam_status'];
        $student->project_status = $validatedData['prj_status'];
        $student->uni_visit_date = $validatedData['visit_date'];
        $student->pass_back = $validatedData['pass_back'];
        $student->sem_year = $validatedData['usemester'];
        $hello = $this->files;
        // dd($hello[0]['file']);
        if ($hello[0]['file'] !== null && count($this->files) > 0) {
            if ($student->documents != null) {
                $existingPdfPath = storage_path('app/public/' . $student->documents);
                // dd($existingPdfPath);
                if (file_exists($existingPdfPath)) {
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
                    foreach ($this->files as $file) {
                        $imagePath = $file['file']->store('documentspdf');
                        $imageFullPath = storage_path('app/' . $imagePath);
        
                        $pdf->AddPage();
                        $pdf->Image($imageFullPath, 10, 10, 190, 0);
                    }
        
                    // Save the updated PDF
                    $updatedPdfPath = 'documentspdf/' . uniqid() . '.pdf';
                    $pdf->Output(storage_path('app/public/' . $updatedPdfPath), 'F');
        
                    // Update the student record with the new PDF path
                    $student->documents = $updatedPdfPath;
                } else {
                    // Existing PDF path is invalid, create new PDF
                    $this->createNewPdf($this->documents, $student);
                }
            } else {
                // No existing PDF, create new PDF
                $this->createNewPdf($this->documents, $student);
            }
        }
        $student->save();
        return redirect()->route('all-student');
    }
    function createNewPdf($documents, $student)
    {
        // Initialize a new PDF document
        $pdf = new Fpdi();

        // Add new images to the PDF
        foreach ($documents as $file) {
            $imagePath = $file->store('documentspdf');
            $imageFullPath = storage_path('app/' . $imagePath);

            $pdf->AddPage();
            $pdf->Image($imageFullPath, 10, 10, 190, 0);
        }

        // Save the new PDF
        $newPdfPath = 'documentspdf/' . uniqid() . '.pdf';
        $pdf->Output(storage_path('app/public/' . $newPdfPath), 'F');

        // Update the student record with the new PDF path
        $student->documents = $newPdfPath;
        $student->save();
    }
    public function updatedUuniversity($uuniversity)
    {


        $this->cousre = Cousre::where('university_id', $this->uuniversity)->get();
        // $this->usession_name = '';
        // $this->uselectedCourse = '';
        // $this->uselectedspecialization = '';
        $this->sessions = admission_session::where('university_id', $this->uuniversity)->get();
        $courseIds = $this->cousre->pluck('id');
        $this->specialization = specializations::whereIn('cousre_id', $this->uuniversity)->get();

    }
    public function updateduselectedCourse($selectedCourse)
    {
        // $this->uselectedspecialization = '';
        $this->specialization = specializations::where('cousre_id', $selectedCourse)->get();

    }
    public function render()
    {
        return view('livewire.updatestudent');
    }
}
