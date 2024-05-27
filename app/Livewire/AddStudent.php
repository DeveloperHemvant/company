<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\Students;
use App\Models\User;
use Livewire\Component;
use App\Models\admission_session;
use App\Models\Cousre;
use App\Models\specializations;
use App\Models\University;
use App\Models\Associate;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule; 
use Illuminate\Validation\ValidationException;

class AddStudent extends Component
{
    public $selectedUniversity;
    public $session_name;
    public $specialization;
    public $admission_type;
    public $cousre;
    public $sessions;
    public $courses;
    public $universities;
    public $university;
    public $selectedCourse ;
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
    public $associate;
    public $selectedassociate;
    public $adhaar;
    public $semester;
    public $selectedspecialization;
    public $documents;
    public $aadhar_no;
   
    use WithFileUploads;


    protected function rules()
    {
        return [
            'selectedUniversity' => 'required',
            'session_name' => 'required',
            'selectedCourse' => 'required',
            'selectedspecialization' => 'required',
            'admission_type' => 'required',
            'fname' => 'required',
            'father_name' => 'required',
            'mother_name' => 'required',
            'dob' => 'required|date',
            'email' => 'required|email',
            'mob' => 'required|digits:10',
            'address' => 'required',
            'pmigration' => 'required',
            'fee' => 'required|numeric',
            'exam_status' => 'required',
            'prj_status' => 'required',
            'visit_date' => 'required|date',
            'pass_back' => 'required',
            'aadhar_no' => [
                'required',
                Rule::unique('students')->where(function ($query) {
                    return $query->where('aadhar_no', $this->aadhar_no)
                                 ->where('session_id', $this->session_name)
                                 ->where('course_id', $this->selectedCourse)
                                 ->whereNull('deleted_at');
                }),
            ],
            'source' => 'required',
            'semester' => 'required',
            'documents.*' => 'file|mimes:jpeg,jpg,png|max:10240',
            'selectedassociate' => Rule::requiredIf($this->source === 'ASSOCIATE'),
        ];
    }
    public function addstudent()
    {
        try {
            $validatedData = $this->validate([
               
                'selectedUniversity' => 'required',
                'session_name' => 'required',
                'selectedCourse' => 'required',
                'selectedspecialization' => 'required',
                'admission_type' => 'required',
                'fname' => 'required',
                'father_name' => 'required',
                'mother_name' => 'required',
                'dob' => 'required',
                'email' => 'required',
                'mob' => 'required',
                'address' => 'required',
                'pmigration' => 'required',
                'fee' => 'required',
                'exam_status' => 'required',
                'prj_status' => 'required',
                'visit_date' => 'required',
                'pass_back' => 'required',
                'aadhar_no' => [
                    'required',
                    // Ensure uniqueness of aadhar_no, session, and course together
                    Rule::unique('students')->where(function ($query) {
                        return $query->where('aadhar_no', $this->aadhar_no)
                                     ->where('session_id', $this->session_name)
                                     ->where('course_id', $this->selectedCourse);
                    })
                ],
                'source' => 'required',
                'selectedassociate' => Rule::requiredIf($this->source === 'ASSOCIATE'),
                'semester' => 'required',
                'documents.*' => 'file|mimes:jpeg,jpg|max:10240',
            ]);
            
            $lastId = Students::latest('id')->value('id');
            $newId = $lastId + 1;
    
            // Create a new instance of the Students model
            $student = new Students;
    
            // Set the attributes
            $student->id = $newId;
            $student->university_id = $validatedData['selectedUniversity'];
            $student->user_id = $validatedData['selectedassociate'];
            $student->associate = User::where(['id'=>$validatedData['selectedassociate']])->pluck('name')->first();
            $student->source = $validatedData['source'];
            $student->name = $validatedData['fname'];
            $student->father_name = $validatedData['father_name'];
            $student->mother_name = $validatedData['mother_name'];
            $student->dob = $validatedData['dob'];
            $student->aadhar_no = $validatedData['aadhar_no'];
            $student->email_id = $validatedData['email'];
            $student->address = $validatedData['address'];
            $student->mob_no = $validatedData['mob'];
            $student->course_id = $validatedData['selectedCourse'];
            $student->specialization_id = $validatedData['selectedspecialization'];
            $student->type = $validatedData['admission_type'];
            $student->session_id = $validatedData['session_name'];
            $student->previous_migration = $validatedData['pmigration'];
            $student->fee = $validatedData['fee'];
            $student->exam_status = $validatedData['exam_status'];
            $student->project_status = $validatedData['prj_status'];
            $student->uni_visit_date = $validatedData['visit_date'];
            $student->pass_back = $validatedData['pass_back'];
            $student->sem_year = $validatedData['semester'];
            // dd($student);
            if ($this->documents != null) {
                $documents = [];
                foreach ($this->documents as $file) {
                    $path = $file->store('documents');
                    $documents[] = storage_path('app/' . $path); // Full path for the image
                }
    
                // Load the view and pass the image paths
                $pdf = PDF::loadView('documentpdf', compact('documents'));
    
                // Generate a unique name for the PDF file
                $pdfFileName = uniqid() . '.pdf';
    
                // Save the PDF to the public storage and get its path
                $pdfPath = 'documentspdf/' . $pdfFileName;
                Storage::disk('public')->put($pdfPath, $pdf->output());
    
                // Save the public path to the student record
                $student->documents = $pdfPath;
            }
    
            $student->save();
            $this->resetForm();
            return redirect()->route('all-student');

        } catch (ValidationException $e) {
            $errors = $e->validator->errors()->all();
            session()->flash('error', $errors[0]);
        } catch (\Exception $e) {
            // Handle other exceptions, such as database constraint violations
            session()->flash('error', $e->getMessage());
        }
    }

    private function resetForm()
    {
        $this->university = null;
        $this->session_name = null;
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
        // $this->cousre = Cousre::all();
        $this->sessions = admission_session::all();
        $this->universities = University::all();
        $this->associate = User::where('usertype', 'associate')->get();

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

    public function render()
    {
        return view('livewire.add-student');
    }
}