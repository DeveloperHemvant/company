<?php

namespace App\Livewire;

use Faker\Factory as FakerFactory;
use Illuminate\Support\Facades\Storage;
use App\Models\Students;
use App\Models\User;
use Livewire\Component;
use App\Models\admission_session;
use App\Models\Cousre;
use App\Models\specializations;
use App\Models\University;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;
use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfReader;
use Mostafaznv\PdfOptimizer\Laravel\Facade\PdfOptimizer;
use Mostafaznv\PdfOptimizer\Enums\ColorConversionStrategy;
use Mostafaznv\PdfOptimizer\Enums\PdfSettings;
class AddStudent extends Component
{
    public $sem_1, $sem_2, $sem_3, $sem_4, $sem_5, $sem_6, $sem_7, $sem_8;
    public $selectedUniversity;
    public $selectedSession;
    public $specialization;
    public $admission_type;
    public $cousre;
    // public $selectedSession;
    public $sessions;
    public $courses;
    public $universities;
    public $university;
    public $selectedCourse;
    public $fname;
    public $lname;
    public $father_name;
    public $mother_name;
    public $dob;
    public $email;
    public $mob;
    public $address;
    public $pmigration;
    public $fee;
    public $exam_status;
    public $prj_status;
    public $visit_date;
    public $pass_back;
    public $board;
    public $source;
    public $refname;
    public $today;
    public $associate;
    public $selectedassociate;
    public $adhaar;
    public $semester;
    public $selectedspecialization;
    public $documents;
    public $aadhar_no;
    public $files = [];
    public $monthDifference;
    use WithFileUploads;
    public function addFile()
    {
        $this->files[] = ['file' => null];
    }
    public function removeFile($index)
    {
        unset($this->files[$index]);
        $this->files = array_values($this->files);
    }
    public function addstudent()
    {
        // Validate form input
        $validatedData = $this->validate([
            'selectedUniversity' => 'required',
            'selectedSession' => 'required',
            'selectedCourse' => 'required',
            'selectedspecialization' => 'required',
            'admission_type' => 'required',
            'fname' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required|date|before_or_equal:' . $this->today,
            'email' => 'required|email',
            'mob' => 'required|digits:10',
            'address' => 'required',
            'pmigration' => 'nullable|required_with:pmigration|date',
            'fee' => 'nullable|required_with:fee|numeric',
            'exam_status' => 'nullable|required_with:exam_status|string',
            'prj_status' => 'nullable|required_with:prj_status|string',
            'visit_date' => 'nullable|required_with:visit_date|date',
            'pass_back' => 'nullable|required_with:pass_back|string',
            'aadhar_no' => [
                'required',
                'numeric',
                'digits:12',
                Rule::unique('students')->where(function ($query) {
                    return $query->where('aadhar_no', $this->aadhar_no)
                        ->where('session_id', $this->selectedSession)
                        ->where('course_id', $this->selectedCourse);
                }),
            ],
            'source' => 'required',
            'selectedassociate' => Rule::requiredIf($this->source === 'ASSOCIATE'),
            'semester' => 'required',
            'files.*.file' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:10240',
        ]);
    
        $lastId = Students::latest('id')->value('id');
        $newId = $lastId + 1;
        $student = new Students;
        $student->id = $newId;
    
        // Assign validated data to the student model
        $student->university_id = $validatedData['selectedUniversity'];
        $student->session_id = $validatedData['selectedSession'];
        $student->course_id = $validatedData['selectedCourse'];
        $student->specialization_id = $validatedData['selectedspecialization'];
        $student->type = $validatedData['admission_type'];
        $student->name = $validatedData['fname'];
        $student->father_name = $validatedData['father_name'];
        $student->mother_name = $validatedData['mother_name'];
        $student->dob = $validatedData['dob'];
        $student->email_id = $validatedData['email'];
        $student->mob_no = $validatedData['mob'];
        $student->address = $validatedData['address'];
        $student->previous_migration = $validatedData['pmigration'];
        $student->fee = $validatedData['fee'];
        $student->exam_status = $validatedData['exam_status'];
        $student->project_status = $validatedData['prj_status'];
        $student->uni_visit_date = $validatedData['visit_date'];
        $student->pass_back = $validatedData['pass_back'];
        $student->aadhar_no = $validatedData['aadhar_no'];
        $student->source = $validatedData['source'];
        $student->sem_year = $validatedData['semester'];
        $student->marksheet_1st_sem = $this->sem_1;
        $student->marksheet_2nd_sem = $this->sem_2;
        $student->marksheet_3rd_sem = $this->sem_3;
        $student->marksheet_4th_sem = $this->sem_4;
        $student->marksheet_5th_sem = $this->sem_5;
        $student->marksheet_6th_sem = $this->sem_6;
        $student->marksheet_7th_sem = $this->sem_7;
        $student->marksheet_8th_sem = $this->sem_8;
    
        // Handle associate data if source is 'ASSOCIATE'
        if ($this->source === 'ASSOCIATE') {
            $student->user_id = $validatedData['selectedassociate'];
            $student->associate = User::where(['id' => $validatedData['selectedassociate']])->pluck('name')->first();
        }
    
        // Process files if uploaded
        if (count($this->files) > 0) {
            $pdfFiles = [];
            foreach ($this->files as $file) {
                if (isset($file['file'])) {
                    $path = $file['file']->store('documentspdf');
                    $extension = pathinfo($path, PATHINFO_EXTENSION);
                    if ($extension === 'pdf') {
                        $pdfFiles[] = storage_path('app/' . $path); // Store absolute path
                    } elseif (in_array($extension, ['png', 'jpeg', 'jpg'])) {
                        $pdfFiles[] = $this->convertImageToPdf(storage_path('app/' . $path));
                    }
                }
            }
    
            // Merge PDFs if any and optimize
            if (!empty($pdfFiles)) {
                $mergedPdfPath = 'documentspdf/' . uniqid() . '.pdf';
                $pdf = new Fpdi();
                foreach ($pdfFiles as $pdfFile) {
                    $pageCount = $pdf->setSourceFile($pdfFile);
                    for ($i = 1; $i <= $pageCount; $i++) {
                        $tplIdx = $pdf->importPage($i);
                        $pdf->AddPage();
                        $pdf->useTemplate($tplIdx);
                    }
                }
                $optimizedPdfPath = $this->optimizePdf($mergedPdfPath);
                Storage::disk('public')->put($optimizedPdfPath, $pdf->Output('S'));
                $student->documents = $optimizedPdfPath;
            }
        }
    
        // Save student record
        $student->save();
    
        // Reset form after saving
        $this->resetForm();
    
        // Redirect to all students page
        return redirect()->route('all-student');
    }
    
    public function convertImageToPdf($imagePath)
    {
        $pdf = Pdf::loadView('documentpdf', ['imagePath' => $imagePath]);
        $imagePdfPath = 'documentspdf/' . uniqid() . '.pdf';
        $optimizedPdfPath = $this->optimizePdf($imagePdfPath);
        Storage::put($optimizedPdfPath, $pdf->output());
        return storage_path('app/' . $optimizedPdfPath); // Return absolute path
    }
    
    protected function optimizePdf($pdfPath)
    {
        try {
            // Optimize the PDF using PdfOptimizer
            $optimizedPdfPath = 'documentspdf/' . uniqid() . '.pdf';
            PdfOptimizer::fromDisk('public')
                ->open($pdfPath)
                ->toDisk('public')
                ->settings(PdfSettings::SCREEN)
                ->colorConversionStrategy(ColorConversionStrategy::DEVICE_INDEPENDENT_COLOR)
                ->colorImageResolution(50)
                ->optimize(storage_path('app/public/' . $optimizedPdfPath));
    
            return $optimizedPdfPath;
        } catch (\Exception $e) {
            // Handle any errors that occur during PDF optimization
            \Log::error('Error optimizing PDF: ' . $e->getMessage());
            return null;
        }
    }
    
    // public function convertImageToPdf($imagePath)
    // {
    //     $pdf = Pdf::loadView('documentpdf', ['imagePath' => $imagePath]);
    //     $imagePdfPath = 'documentspdf/' . uniqid() . '.pdf';
    //     $optimizedPdfPath = $this->optimizePdf($imagePdfPath);
    //     Storage::put($optimizedPdfPath, $pdf->output());
    //     return storage_path('app/' . $imagePdfPath);
    // }
    // protected function optimizePdf($pdfPath)
    // {
    //     try {
    //         // Optimize the PDF using PdfOptimizer
    //         $optimizedPdfPath = 'documentspdf/' . uniqid() . '.pdf';
    //         PdfOptimizer::fromDisk('local')
    //             ->open(storage_path('app/public/' . $pdfPath))
    //             ->toDisk('local')
    //             ->settings(PdfSettings::SCREEN)
    //             ->colorConversionStrategy(ColorConversionStrategy::DEVICE_INDEPENDENT_COLOR)
    //             ->colorImageResolution(50)
    //             ->optimize(storage_path('app/public/' . $optimizedPdfPath));

    //         return $optimizedPdfPath;
    //     } catch (\Exception $e) {
    //         // Handle any errors that occur during PDF optimization
    //         \Log::error('Error optimizing PDF: ' . $e->getMessage());
    //         return null;
    //     }
    // }
    public function resetForm()
    {
        $this->university = null;
        $this->selectedSession = null;
        $this->selectedCourse = null;
        $this->specialization = null;
        $this->admission_type = null;
        $this->fname = null;
        $this->lname = null;
        $this->father_name = null;
        $this->mother_name = null;
        $this->dob = null;
        $this->email = null;
        $this->mob = null;
        $this->address = null;
        $this->pmigration = null;
        $this->fee = null;
        $this->exam_status = null;
        $this->prj_status = null;
        $this->visit_date = null;
        $this->pass_back = null;
        $this->board = null;
        $this->source = null;
        $this->associate = null;
        $this->selectedassociate = null;
        $this->adhaar = null;
        $this->semester = null;
        $this->documents = null;
    }

    public function mount()
    {
        $this->today = Carbon::today()->toDateString();
        $this->universities = University::all();
        $this->associate = User::where('usertype', 'associate')->get();
        $this->files[] = ['file' => null];
    }
    /* method to for dropdown */
    public function updatedSelectedUniversity($selectedUniversity)
    {
        if (!is_null($selectedUniversity)) {
            $this->cousre = Cousre::where('university_id', $selectedUniversity)->get();
            $this->sessions = admission_session::where('university_id', $selectedUniversity)->get();
        }
    }
    public function updatedSelectedCourse($selectedCourse)
    {
        if (!is_null($selectedCourse)) {
            $this->specialization = specializations::where('cousre_id', $selectedCourse)->get();
        }
    }
    public function updatedSelectedSession($id)
    {
        $session_diff = admission_session::find($id);
        $startDate = Carbon::createFromFormat('Y-m', $session_diff->startmonth);
        $endDate = Carbon::createFromFormat('Y-m', $session_diff->endmonth);
        $this->monthDifference = $startDate->diffInMonths($endDate);
    }

    public function render()
    {
        return view('livewire.add-student');
    }
}