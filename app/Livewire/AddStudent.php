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
        // try {
        $validatedData = $this->validate([
            'selectedUniversity' => 'required',
            'session_name' => 'required',
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
                        ->where('session_id', $this->session_name)
                        ->where('course_id', $this->selectedCourse);
                }),
            ],
            'source' => 'required',
            'selectedassociate' => Rule::requiredIf($this->source === 'ASSOCIATE'),
            'semester' => 'required',
            'files.*.file' => 'nullable|file|mimes:jpeg,png,jpg|max:10240',
        ], [
            'selectedUniversity.required' => 'The university selection is required.',
            'session_name.required' => 'The session name is required.',
            'selectedCourse.required' => 'The course selection is required.',
            'selectedspecialization.required' => 'The specialization selection is required.',
            'admission_type.required' => 'The admission type is required.',
            'fname.required' => 'The first name is required.',
            'father_name.required' => 'The father\'s name is required.',
            'mother_name.required' => 'The mother\'s name is required.',
            'dob.required' => 'The date of birth is required.',
            'dob.date' => 'The date of birth must be a valid date.',
            'email.required' => 'The email address is required.',
            'email.email' => 'The email address must be a valid email.',
            'mob.required' => 'The mobile number is required.',
            'mob.digits' => 'The mobile number must be 10 digits.',
            'address.required' => 'The address is required.',
            'pmigration.required_with' => 'The migration date is required when pmigration is present.',
            'pmigration.date' => 'The migration date must be a valid date.',
            'fee.required_with' => 'The fee is required when fee is present.',
            'fee.numeric' => 'The fee must be a valid number.',
            'exam_status.required_with' => 'The exam status is required when exam status is present.',
            'exam_status.string' => 'The exam status must be a valid string.',
            'prj_status.required_with' => 'The project status is required when prj status is present.',
            'prj_status.string' => 'The project status must be a valid string.',
            'visit_date.required_with' => 'The visit date is required when visit date is present.',
            'visit_date.date' => 'The visit date must be a valid date.',
            'pass_back.required_with' => 'The pass back status is required when pass back is present.',
            'pass_back.string' => 'The pass back status must be a valid string.',
            'aadhar_no.required' => 'The Aadhar number is required.',
            'aadhar_no.unique' => 'The Aadhar number has already been taken for this session and course.',
            'source.required' => 'The source is required.',
            'selectedassociate.required_if' => 'The associate selection is required when the source is ASSOCIATE.',
            'refname.required_if' => 'The reference name is required when the source is not ASSOCIATE.',
            'semester.required' => 'The semester is required.',
            'files.*.file.required_with' => 'Each file is required when a file is present.',
            'files.*.file.file' => 'Each file must be a valid file type.',
            'files.*.file.mimes' => 'Each file must be of type: jpeg, png, jpg.',
            'files.*.file.max' => 'Each file must not be greater than 10MB.',
        ]);
        $lastId = Students::latest('id')->value('id');
        $newId = $lastId + 1;
        $student = new Students;
        $student->id = $newId;
        $student->university_id = $validatedData['selectedUniversity'];
        if ($this->source === 'ASSOCIATE') {
            $student->user_id = $validatedData['selectedassociate'];
            $student->associate = User::where(['id' => $validatedData['selectedassociate']])->pluck('name')->first();
        }
        // else {
        //     $faker = FakerFactory::create();
        //     $newuser = User::factory()->create([
        //         'name' => $this->refname,
        //         'email' => $faker->unique()->safeEmail,
        //         'city' => $faker->city,
        //         'mobile' => $faker->phoneNumber,
        //         'password' => Hash::make('password'), 
        //         'address' => $faker->address,
        //         'pincode' => $faker->postcode,
        //         'state' => $faker->state,
        //         'pname' => $faker->name,
        //         'smobile' => $faker->phoneNumber,
        //         'landmobile' => $faker->phoneNumber,
        //     ]);
        //     $student->user_id=$newuser->id;
        //     $student->associate =User::where(['id' => $newuser->id])->pluck('name')->first();
        // }
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


        if ($this->files) {
            $documents = [];
            foreach ($this->files as $file) {
                if (isset($file['file'])) {
                    $path = $file['file']->store('documents');
                    $documents[] = storage_path('app/' . $path); // Full path for the image
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

        $student->save();
        $this->resetForm();
        return redirect()->route('all-student');

        // } catch (ValidationException $e) {
        //     $errors = $e->validator->errors()->all();
        //     session()->flash('error', $errors[0]);
        // } catch (\Exception $e) {
        //     // Handle other exceptions, such as database constraint violations
        //     session()->flash('error', $e->getMessage());
        // }
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
        $this->today = Carbon::today()->toDateString();
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