<?php
namespace App\Livewire;
use Carbon\Carbon;
use App\Models\University;
use Illuminate\Validation\Rule;
use App\Models\admission_session;
use Livewire\Component;
use DateTime;
use Livewire\WithPagination;
use App\Exports\AdmissionSessionExport;
use DB;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;


class SessionDetails extends Component
{
    use WithPagination;
    public $showAddForm = false;
    public $showEditForm = false;
    public $startmonth;
    public $endmonth;
    public $sessiondata;
    public $name;
    public $universities;
    public $university_id;
    public $paginationData;
    public $u_search='';
    public $search='';
    public function mount()
    {
        
        $this->universities = University::all();
    }
    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
        $this->university_id = '';
        $this->resetdata();
    }
    public function save()
{
    $validatedData = $this->validate([
        'startmonth' => 'required|date_format:Y-m',
        'endmonth' => 'required|date_format:Y-m',
        'university_id' => 'required'
    ], [
        'startmonth.required' => 'The start month is required.',
        'endmonth.required' => 'The end month is required.',
        'university_id.required' => 'Select the University',
    ]);

    // Calculate the month difference
    $startDateTime = new DateTime($this->startmonth);
$endDateTime = new DateTime($this->endmonth);
$interval = $startDateTime->diff($endDateTime);
$monthDiff = ($interval->y * 12) + $interval->m;

// Check if the month difference is allowed
if (!in_array($monthDiff, [6, 11, 12, 23, 24,35,36,47,48])) {
    session()->flash('error', 'Enter the months correctly.');
    return;
}

// $this->monthDifference = $monthDiff;


    $name = $startDateTime->format('F'). ' ' . $startDateTime->format('Y') . '-' . $endDateTime->format('F') . ' ' . $endDateTime->format('Y');
    $this->name = $name;
        // dd($this->name);
    $validatedData['name'] = $name;

    $this->validate([
        'name' => [
            'required',
            Rule::unique('admission_sessions')->where(function ($query) {
                return $query->where('name', $this->name)->where('university_id', $this->university_id);
            }),
        ],
    ], [
        'name.required' => 'The session name is required.',
        'name.unique' => 'The session already exists.',
    ]);

    $admission_session = new admission_session;
    $admission_session->name = $name;
    $admission_session->startmonth = $this->startmonth;
    $admission_session->endmonth = $this->endmonth;
    $admission_session->university_id = $this->university_id;
    $admission_session->save();

    session()->flash('status', 'Session created successfully');
    $this->resetdata();
    // $this->refreshData();
    $this->showAddForm = false;
}
    public $session_id;
    public function edit($id)
    {
        $this->showEditForm = true;
        $data = admission_session::find($id);
        $this->startmonth = $data->startmonth;
        $this->endmonth = $data->endmonth;
        $this->session_id = $data->id;
        $this->university_id = $data->university_id;
    }
    public function update()
    {
        $validatedData = $this->validate([
            'startmonth' => 'required',
            'endmonth' => 'required',
            'university_id' => 'required',
        ], [
            'startmonth.required' => 'The start month is required.',
            'endmonth.required' => 'The end month is required.',
            'university_id.required' => 'Select the University',
        ]);
        $startDateTime = new DateTime($this->startmonth);
        $endDateTime = new DateTime($this->endmonth);
        $name = $startDateTime->format('F') . '-' . $endDateTime->format('F') . ' ' . $startDateTime->format('Y');
        $validatedData['name'] = $name;
        $admission_session = admission_session::find($this->session_id);
        if (!$admission_session) {
            return;
        }
        if ($admission_session->name !== $name && admission_session::where('name', $name)->exists()) {
            $this->addError('name', 'The session already exists.');
            return;
        }
        $admission_session->name = $name;
        $admission_session->startmonth = $this->startmonth;
        $admission_session->endmonth = $this->endmonth;
        $admission_session->university_id = $this->university_id;
        $admission_session->save();
        session()->flash('status', 'Session Updated successfully');
        $this->resetdata();
        $this->showEditForm = false;
        // $this->refreshData();
    }


    public function resetdata()
    {
        $this->startmonth = '';
        $this->endmonth = '';
    }
    public $postIdToDelete;
    public function confirmDelete($postId)
    {
        $this->postIdToDelete = $postId;
        // dd($this->postIdToDelete);

        $this->dispatch('delete');
    }
    #[On('goOn-Delete')]
    public function delete()
    {
        $session = admission_session::with('student')->find($this->postIdToDelete);
        // dd($session->student->count());
        if ($session->student->count() > 0 ) {
        
            $this->dispatch('alert', [
                'type' => 'warning',
                'title' => 'Warning',
                'position' => 'center',
                'text' => 'Please delete all the related data regarding this Session first.'
            ]);
        } else {
            $session->delete();
    
            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Success',
                'position' => 'center',
                'text' => 'Session deleted successfully.'
            ]);
            // $this->refreshData();
        }
        // $this->refreshData();
    }
    public function export()
    {
        $sessionData = admission_session::with('university')->where('name', 'like', '%' . $this->search . '%')->where('university_id', 'like', '%' . $this->u_search . '%')->get();
    
        // Apply search filters if they are not empty
        return Excel::download(new AdmissionSessionExport($sessionData), 'session.xlsx');     
        // dd($sessionData);
    }
    
    public function render()
{
        $query = admission_session::with('university')
        ;
        // dd($this->search);
    // Apply search filters if they are not empty
    if ($this->search) {
        $query->where('admission_sessions.name', 'like', '%' . $this->search . '%');
    }

    if ($this->u_search) {
        $query->where('admission_sessions.university_id', 'like', '%' . $this->u_search . '%');
    }

    $sessionData = $query->orderBy('id', 'desc')->paginate(10);
        // dd($sessionData);
    return view('livewire.session-details', [
        'sessionData' => $sessionData,
    ]);
}

}
