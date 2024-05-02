<?php

namespace App\Livewire;
use App\Models\Associate;
use App\Models\AdmissionSession;
use App\Models\University;
use Livewire\Component;
// use Livewire\Attributes\Validate;
use Carbon\Carbon;
class SessionDetails extends Component
{
    public $showAddForm = false;

    public $showEditForm = false;
    public $selectedMonth;
    public $university;
    public $sessionName;

    public $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4=>'April',
        5=>'May',
        6=>'June',
        7=>'July',
        8=>'August',
        9=>'September',
        10=>'Octuber',
        11=>'November',
        12=>'December'
    ];

    public function mount()
    {
        $this->selectedMonth = null;
    }
    public function toggleAddForm()
    {
     
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = !$this->showEditForm;
    }
    public function save()
    {
        $this->validate([
            'university' => 'required', // Add any other validation rules as needed
            'selectedMonth' => 'required',
        ]);
    
        $universityId = $this->university;
        $selectedMonth = str_pad($this->selectedMonth, 2, '0', STR_PAD_LEFT); // Ensure two-digit format
    
        $currentYear = Carbon::now()->year;
        $nextYear = Carbon::now()->addYear()->year;
        
        $sessionName = $selectedMonth.' '. $currentYear.'-'.$nextYear;
        
        // Check if a session with the same name already exists for the selected university
        $existingSession = AdmissionSession::where('session_name', $sessionName)
            ->where('university_id', $universityId)
            ->first();
        dd($existingSession);
    
        if ($existingSession) {
            session()->flash('error', 'A session with the same name already exists for the selected university.');
            return;
        }else{
                // Create the new session
        AdmissionSession::create([
            'session_name' => $sessionName,
            'month' => $selectedMonth,
            'year' => $currentYear . ' ' . $nextYear,
            'university_id' => $universityId,
        ]);
    
        }
    
        
        //session()->flash('success', 'Session created successfully.');
        //$this->toggleAddForm(); // Reset the form fields
    }
    public function render()
    {
        $session = AdmissionSession::all();
        $university = University::all();
        $associate = Associate::all();
        return view('livewire.session-details',['session'=>$session,'universities'=>$university,'associates'=>$associate,'months'=>$this->months]);
    }
}
