<?php

namespace App\Livewire;

use App\Models\Associate;
use App\Models\admission_session;
use App\Models\University;
use Livewire\Component;
// use Livewire\Attributes\Validate;
use Carbon\Carbon;

class SessionDetails extends Component
{
    public $u_month;
    public $u_university;
    public $showAddForm = false;

    public $showEditForm = false;
    public $selectedMonth;
    public $university;
    public $sessionName;
    public $session_id;
    public $month;
    public $year;
    public $u_session;
    public $months = [
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'Octuber',
        11 => 'November',
        12 => 'December'
    ];

    public function mount()
    {
        $this->selectedMonth = null;
    }
    public function toggleAddForm()
    {

        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = !$this->showEditForm;
        $this->resetForm();
    }
    public function save()
    {
        $this->validate([
            'university' => 'required',
            'selectedMonth' => 'required',
        ]);

        $universityId = $this->university;
        $selectedMonth = str_pad($this->selectedMonth, 2, '0', STR_PAD_LEFT);

        $currentYear = Carbon::now()->year;
        $nextYear = Carbon::now()->addYear()->year;

        $sessionName = $selectedMonth . ' ' . $currentYear . '-' . $nextYear;
        $year = $currentYear . ' ' . $nextYear;
        $admissionSession = new admission_session;
        $admissionSession->session_name = $sessionName;
        $admissionSession->month = $selectedMonth;
        $admissionSession->year = $currentYear . ' ' . $nextYear;
        $admissionSession->u_id = $universityId;
        $admissionSession->save();
        $this->resetForm();
        $this->toggleAddForm();
    }
    public function resetForm()
    {
        $this->university = '';
        $this->selectedMonth = '';

    }
    public $u_id;
    public function edit($id)
    {
        $session = admission_session::with('university')->find($id);
        $this->u_id = $session->u_id;
        $this->university = $session->university->id;
        $this->selectedMonth = $session->month;
        $this->session_id = $id;
        $this->u_session = $session;
        $this->showAddForm = false;
        $this->showEditForm = true;
    }
    public function update()
    {
        $session = admission_session::find($this->session_id);
        $selectedMonth = str_pad($this->selectedMonth, 2, '0', STR_PAD_LEFT);

        $currentYear = Carbon::now()->year;
        $nextYear = Carbon::now()->addYear()->year;

        $sessionName = $selectedMonth . ' ' . $currentYear . '-' . $nextYear;
        if ($session) {
            $session->update([
                'month' => $this->selectedMonth,
                'u_id' => $this->university,
                'session_name' => $sessionName
            ]);
            session()->flash('status', 'Session updated successfully');
        } else {
            session()->flash('status', 'Failed to update Session');
        }

        $this->showEditForm = false;
    }
    public function delete($id)
    {
        admission_session::find($id)->delete();
    }
    public function render()
    {
        $session = admission_session::all();
        $university = University::all();
        $associate = Associate::all();
        return view('livewire.session-details', ['session' => $session, 'universities' => $university, 'associates' => $associate, 'months' => $this->months]);
    }
}
