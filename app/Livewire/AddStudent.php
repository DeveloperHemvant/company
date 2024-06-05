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
    public $refname;
    public $associate;
    public $selectedassociate;
    public $adhaar;
    public $semester;
    public $selectedspecialization;
    public $documents;
    public $aadhar_no;
    public $files = [];
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
                'pmigration' =>'nullable|rrequired_with:pmigration',
                'fee' => 'nullable|rrequired_with:fee',
                'exam_status' => 'nullable|required_with:exam_status',
                'prj_status' =>'nullable|required_with:prj_status',
                'visit_date' => 'nullable|required_with:visit_date',
                'pass_back' =>'nullable|rrequired_with:pass_back',
                'aadhar_no' => [
                    'required',
                    Rule::unique('students')->where(function ($query) {
                        return $query->where('aadhar_no', $this->aadhar_no)
                                     ->where('session_id', $this->session_name)
                                     ->where('course_id', $this->selectedCourse);
                    })
                ],
                'source' => 'required',
                'selectedassociate' => Rule::requiredIf($this->source === 'ASSOCIATE'),
                'refname'=>Rule::requiredIf($this->source != 'ASSOCIATE'),
                'semester' => 'required',
                'files.*.file' => 'required_with:files.*.file|file|mimes:jpeg,png,jpg|max:10240',
            ]);
            $lastId = Students::latest('id')->value('id');
            $newId = $lastId + 1;
            $student = new Students;
            $student->id = $newId;
            $student->university_id = $validatedData['selectedUniversity'];
            if ($this->source === 'ASSOCIATE') {
                $student->user_id = $validatedData['selectedassociate'];
                $student->associate = User::where(['id' => $validatedData['selectedassociate']])->pluck('name')->first();
            } else {
                $faker = FakerFactory::create();
                $newuser = User::factory()->create([
                    'name' => $this->refname,
                    'email' => $faker->unique()->safeEmail,
                    'city' => $faker->city,
                    'mobile' => $faker->phoneNumber,
                    'password' => Hash::make('password'), 
                    'address' => $faker->address,
                    'pincode' => $faker->postcode,
                    'state' => $faker->state,
                    'pname' => $faker->name,
                    'smobile' => $faker->phoneNumber,
                    'landmobile' => $faker->phoneNumber,
                ]);
                $student->user_id=$newuser->id;
                $student->associate =User::where(['id' => $newuser->id])->pluck('name')->first();
            }
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

           
            $documents = [];
            foreach ($this->files as $file) {
                if (isset($file['file'])) {
                    $path = $file['file']->store('documents');
                    $documents[] = storage_path('app/' . $path); // Full path for the image
                }
            }

            $pdf = PDF::loadView('documentpdf', compact('documents'));
            $pdfFileName = uniqid() . '.pdf';
            $pdfPath = 'documentspdf/' . $pdfFileName;
            Storage::disk('public')->put($pdfPath, $pdf->output());
            $student->documents = $pdfPath;

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

    public function render()
    {
        return view('livewire.add-student');
    }
}