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
use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class Updatestudent extends Component
{
    use WithFileUploads;
    public $sem_1, $sem_2, $sem_3, $sem_4, $sem_5, $sem_6, $sem_7, $sem_8;
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
    public $uselectedSession;
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
    public $monthDifference;
    public $mob;
    public $address;
    public $pmigration;
    public $fee;
    public $exam_status;
    public $prj_status;
    public $visit_date;
    public $pass_back;
    public $documents;
    public $refname;

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
        $this->uselectedSession = $this->studentdata->session_id;
        $this->uselectedCourse = $this->studentdata->course_id;
        // dd($this->uselectedSession);
        $this->specialization = specializations::where('cousre_id', $this->uselectedCourse)->get();
        $this->uselectedspecialization = $this->studentdata->specialization_id;
        $this->refname = $this->studentdata->associate;
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
        $this->sem_1 = $this->studentdata->marksheet_1st_sem;
    $this->sem_2 = $this->studentdata->marksheet_2nd_sem;
    $this->sem_3 = $this->studentdata->marksheet_3rd_sem;
    $this->sem_4 = $this->studentdata->marksheet_4th_sem;
    $this->sem_5 = $this->studentdata->marksheet_5th_sem;
    $this->sem_6 = $this->studentdata->marksheet_6th_sem;
    $this->sem_7 = $this->studentdata->marksheet_7th_sem;
    $this->sem_8 = $this->studentdata->marksheet_8th_sem;
        $this->university = University::all();
        $this->cousre = Cousre::where('university_id', $this->studentdata->university_id)->get();
        $this->sessions = admission_session::where('university_id', $this->studentdata->university_id)->get();
        // $this->uselectedSession = admission_session::where('id', $this->studentdata->session_id)->get()->value('name');
        $this->associate = User::where('usertype', 'associate')->get();
        $this->files[] = ['file' => null];
        $session_diff = admission_session::find($this->studentdata->session_id);
        // dd($session_diff->endmonth);

        $startDate = Carbon::createFromFormat('Y-m', $session_diff->startmonth);
$endDate = Carbon::createFromFormat('Y-m', $session_diff->endmonth);

// Calculate the difference in months
$this->monthDifference = $startDate->diffInMonths($endDate);

        // dd($this->associate);
    }
    public function updatestudent()
{
    $validatedData = $this->validate([
        'uuniversity' => 'required',
        'uselectedSession' => 'required',
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
                    ->where('session_id', $this->uselectedSession)
                    ->where('course_id', $this->uselectedCourse);
            })->ignore($this->id),
        ],
        'mob' => 'required|numeric|digits:10',
        'address' => 'required|string',
        'pmigration' => 'nullable|required_with:pmigration|date',
        'fee' => 'nullable|required_with:fee|numeric',
        'exam_status' => 'nullable|required_with:exam_status|string',
        'prj_status' =>'nullable|required_with:prj_status|string',
        'visit_date' =>'nullable|required_with:visit_date|date', 
        'pass_back' =>'nullable|required_with:pass_back|string', 
    ]);

    $student = Students::findOrFail($this->id);
    $student->university_id = $validatedData['uuniversity'];
    $student->user_id = $validatedData['uassociate'];
    
    if ($this->usource === 'ASSOCIATE') {
        $student->associate = User::where(['id' => $validatedData['uassociate']])->pluck('name')->first();
        $student->source = $validatedData['usource'];
    } else {
        $student->source = $validatedData['usource'];
        $student->associate = '';
    }
        // dd($validatedData);
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
    $student->session_id = $validatedData['uselectedSession'];
    $student->previous_migration = $validatedData['pmigration'];
    $student->fee = $validatedData['fee'];
    $student->exam_status = $validatedData['exam_status'];
    $student->project_status = $validatedData['prj_status'];
    $student->uni_visit_date = $validatedData['visit_date'];
    $student->pass_back = $validatedData['pass_back'];
    $student->sem_year = $validatedData['usemester'];
    $student->marksheet_1st_sem = $this->sem_1;
        $student->marksheet_2nd_sem = $this->sem_2;
        $student->marksheet_3rd_sem = $this->sem_3;
        $student->marksheet_4th_sem = $this->sem_4;
        $student->marksheet_5th_sem = $this->sem_5;
        $student->marksheet_6th_sem = $this->sem_6;
        $student->marksheet_7th_sem = $this->sem_7;
        $student->marksheet_8th_sem = $this->sem_8;

    if (is_array($this->files) && isset($this->files[0]['file']) && !empty($this->files)) {
        if ($student->documents != null) {
            $existingPdfPath = storage_path('app/public/' . $student->documents);
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
                    if (isset($file['file'])) {
                        $imagePath = $file['file']->store('documentspdf');
                        $imageFullPath = storage_path('app/' . $imagePath);

                        $pdf->AddPage();
                        $pdf->Image($imageFullPath, 10, 10, 190, 0);
                    }
                }

                // Save the updated PDF
                $updatedPdfPath = 'documentspdf/' . uniqid() . '.pdf';
                $pdf->Output(storage_path('app/public/' . $updatedPdfPath), 'F');

                // Update the student record with the new PDF path
                $student->documents = $updatedPdfPath;
            } else {
                // Existing PDF path is invalid, create new PDF
                $this->createNewPdf($this->files, $student);
            }
        } else {
            // No existing PDF, create new PDF
            $this->createNewPdf($this->files, $student);
        }
    }

    $student->save();

    return redirect()->route('all-student');
}

protected function createNewPdf($files, $student)
{
    $documents = [];
    foreach ($files as $file) {
        if (isset($file['file'])) {
            $path = $file['file']->store('documents');
            $documents[] = storage_path('app/' . $path);
        }
    }

    if (!empty($documents)) {
        $pdf = Pdf::loadView('documentpdf', compact('documents'));
        $pdfFileName = uniqid() . '.pdf';
        $pdfPath = 'documentspdf/' . $pdfFileName;
        Storage::disk('public')->put($pdfPath, $pdf->output());
        $student->documents = $pdfPath;
    }
}
    public function updatedUuniversity($uuniversity)
    {


        $this->cousre = Cousre::where('university_id', $this->uuniversity)->get();
        // $this->uselectedSession = '';
        // $this->uselectedCourse = '';
        // $this->uselectedspecialization = '';
        $this->sessions = admission_session::where('university_id', $this->uuniversity)->get();
        $courseIds = $this->cousre->pluck('id');
        $this->specialization = specializations::whereIn('cousre_id', $courseIds)->get();

    }
    public function updateduselectedCourse($selectedCourse)
    {
        // $this->uselectedspecialization = '';
        $this->specialization = specializations::where('cousre_id', $selectedCourse)->get();

    }
    public function updatedUselectedSession($id){
        $session_diff = admission_session::find($id);
        // dd($session_diff->endmonth);

        $startDate = Carbon::createFromFormat('Y-m', $session_diff->startmonth);
$endDate = Carbon::createFromFormat('Y-m', $session_diff->endmonth);
        $this->usemester = '';

// Calculate the difference in months
$this->monthDifference = $startDate->diffInMonths($endDate);
        //dd($this->monthDifference);
    }
    
    public function render()
    {
        return view('livewire.updatestudent');
    }
}
