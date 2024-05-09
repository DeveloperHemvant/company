<?php

namespace App\Livewire;

use Illuminate\Validation\Rule;
use App\Models\admission_session;
use Livewire\Component;
use DateTime;

class SessionDetails extends Component
{
    public $showAddForm = false;
    public $showEditForm = false;
    public $startmonth;
    public $endmonth;
    public $sessiondata;
    public $name;
    public function mount()
    {
        $this->sessiondata = admission_session::all();
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
        ], [
            'startmonth.required' => 'The start month is required.',
            'endmonth.required' => 'The end month is required.',
        ]);

        // Generate the name
        $startDateTime = new DateTime($this->startmonth);
        $endDateTime = new DateTime($this->endmonth);
        $name = $startDateTime->format('F') . '-' . $endDateTime->format('F') . ' ' . $startDateTime->format('Y');
        // Validate unique name
        $this->name = $name;
        $validatedData['name'] = $name;
        $this->validate([
            'name' => [
                'required',
                Rule::unique('admission_sessions')->where(function ($query) {
                    return $query->where('name', $this->name);
                }),
            ],
        ], [
            'name.required' => 'The session  is required.',
            'name.unique' => 'The session  already exists.',
        ]);

        // Create and save the admission session
        $admission_session = new admission_session;
        $admission_session->name = $name;
        $admission_session->startmonth = $this->startmonth;
        $admission_session->endmonth = $this->endmonth;
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
    }
    public function update()
    {
        $validatedData = $this->validate([
            'startmonth' => 'required',
            'endmonth' => 'required',
        ], [
            'startmonth.required' => 'The start month is required.',
            'endmonth.required' => 'The end month is required.',
        ]);
        $startDateTime = new DateTime($this->startmonth);
        $endDateTime = new DateTime($this->endmonth);
        $name = $startDateTime->format('F') . '-' . $endDateTime->format('F') . ' ' . $startDateTime->format('Y');
        $validatedData['name'] = $name;
        $this->validate([
            'name' => [
                'required',
                Rule::unique('admission_sessions')->where(function ($query) {
                    return $query->where('name', $this->name);
                }),
            ],
        ], [
            'name.required' => 'The session  is required.',
            'name.unique' => 'The session  already exists.',
        ]);
        // Find the admission session record by its ID
        $admission_session = admission_session::find($this->session_id);

        // Update the fields
        $admission_session->name = $name;
        $admission_session->startmonth = $this->startmonth;
        $admission_session->endmonth = $this->endmonth;

        // Save the changes
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
    public function delete($id)
    {
        admission_session::find($id)->delete();
    }
    public function refreshData(): void
    {
        $this->sessiondata = admission_session::all();
    }
    public function render()
    {
        return view('livewire.session-details');
    }
}
