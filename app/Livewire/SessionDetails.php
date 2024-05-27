<?php
namespace App\Livewire;

use App\Models\University;
use Illuminate\Validation\Rule;
use App\Models\admission_session;
use Livewire\Component;
use DateTime;
use Livewire\WithPagination;
use DB;
use Livewire\Attributes\On;


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
    public function mount()
    {
        
        $this->universities = University::all();
    }
    public function toggleAddForm()
    {
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
        $this->resetdata();
    }
    public function save()
    {
        $validatedData = $this->validate([
            'startmonth' => 'required',
            'endmonth' => 'required',
            'university_id' => 'required'
        ], [
            'startmonth.required' => 'The start month is required.',
            'endmonth.required' => 'The end month is required.',
            'university_id.required' => 'Select the University',
        ]);
        $startDateTime = new DateTime($this->startmonth);
        $endDateTime = new DateTime($this->endmonth);
        $name = $startDateTime->format('F') . '-' . $endDateTime->format('F') . ' ' . $startDateTime->format('Y');
        $this->name = $name;
        $validatedData['name'] = $name;
        $this->validate([
            'name' => [
                'required',
                Rule::unique('admission_sessions')->where(function ($query) {
                    return $query->where('name', $this->name)->where('university_id', $this->university_id);
                }),
            ],
        ], [
            'name.required' => 'The session  is required.',
            'name.unique' => 'The session  already exists.',
        ]);
        $admission_session = new admission_session;
        $admission_session->name = $name;
        $admission_session->startmonth = $this->startmonth;
        $admission_session->endmonth = $this->endmonth;
        $admission_session->university_id = $this->university_id;
        $admission_session->save();

        $this->resetdata();
        $this->refreshData();
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
        $this->resetdata();
        $this->showEditForm = false;
        $this->refreshData();
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
            $this->refreshData();
        }
        
        $this->refreshData();
    }
    public function refreshData(): void
    {
        //$this->paginationData = admission_session::with('university')->paginate(1);
    }
    public function render()
    {
        // DB::enableQueryLog();

        // Fetch the paginated session data
        $sessionData = admission_session::with('university')->paginate(10);
    
        // Retrieve the executed SQL queries
        // $queries = DB::getQueryLog();
        // dd($queries); // Check the generated SQL queries
    
        // Pass the session data to the view
        return view('livewire.session-details', [
            'sessionData' => $sessionData,
        ]);
    }
}
