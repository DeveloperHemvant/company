<?php

namespace App\Livewire;

use App\Models\Associate;
use App\Models\University;
use Livewire\Component;
use App\Models\CourierRecord;
use Livewire\Attributes\On;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CourierExport;
class Courierdetails extends Component
{
    public $type;
    public $records;
    public $recordId;
    public $s_delivery='';
    public $s_tracking_no='';

    public $formType;
    public $particular_details;

    public $courier_type;
    public $tracking_no;
    public $delivery_status;
    public $remarks;
    public $associateData;
    public $deleteid;
    public $s_formType = '';
    public $universityData;

    public $search = '';
    public $showAddForm = false;
    public $showEditForm = false;

    public function mount()
    {
        $this->associateData = Associate::all();
        // dd($this->associateData);
        $this->universityData = University::all();
        // $this->records = CourierRecord::where('form_type', 'like', '%' . $this->s_formType . '%')->get();

    }
    public function export(){
        return Excel::download(new CourierExport($this->records), 'courier_details.xlsx');
    }
    public function edit($id)
    {
        $record = CourierRecord::find($id);
        $this->recordId = $record->id;
        $this->type = $record->type;
        $this->particular_details = $record->particular_details;
        $this->courier_type = $record->courier_type;
        $this->tracking_no = $record->tracking_no;
        $this->delivery_status = $record->delivery_status;
        $this->remarks = $record->remarks;
        $this->formType = $record->form_type;
        $this->showEditForm = true;
    }
    public function update(){
        $updatedrecord = CourierRecord::find($this->recordId);
        $validatedData = $this->validate([
            'type' => 'required',
            'particular_details' => 'required',
            'courier_type' => 'required',
            'tracking_no' => 'required',
            'delivery_status' => 'required',
            'remarks' => 'required',
            'formType' => 'required',
        ]);
        // dd($validatedData);
        // $record = new CourierRecord();
        $updatedrecord->type = $validatedData['type'];
        $updatedrecord->particular_details = $validatedData['particular_details'];
        $updatedrecord->courier_type = $validatedData['courier_type'];
        $updatedrecord->tracking_no = $validatedData['tracking_no'];
        $updatedrecord->delivery_status = $validatedData['delivery_status'];
        $updatedrecord->remarks = $validatedData['remarks'];
        $updatedrecord->form_type = $validatedData['formType'];

        $updatedrecord->save();
        $this->showEditForm = false;
        $this->resetForm();

    }
    public function resetForm()
    {
        $this->recordId = null;
        $this->type = '';
        $this->particular_details = '';
        $this->courier_type = '';
        $this->tracking_no = '';
        $this->delivery_status = '';
        $this->remarks = '';
        $this->form_type = '';
    }
    public function save()
    {
        // dd($this->formType);
        $validatedData = $this->validate([
            'type' => 'required',
            'particular_details' => 'required',
            'courier_type' => 'required',
            'tracking_no' => 'required',
            'delivery_status' => 'required',
            'remarks' => 'required',
            'formType' => 'required',
        ]);
        // dd($validatedData);
        $record = new CourierRecord();
        $record->type = $validatedData['type'];
        $record->particular_details = $validatedData['particular_details'];
        $record->courier_type = $validatedData['courier_type'];
        $record->tracking_no = $validatedData['tracking_no'];
        $record->delivery_status = $validatedData['delivery_status'];
        $record->remarks = $validatedData['remarks'];
        $record->form_type = $validatedData['formType'];

        $record->save();

        session()->flash('message', 'Courier record added successfully!');

        // $this->resetFormFields();
        $this->reset();
    }
    public function deleteconfirmation($id)
    {
        $this->deleteid = $id;
        $this->dispatch('delete');
        
    }
    #[On('goOn-Delete')]
    public function delete(){
        CourierRecord::find($this->deleteid)->delete();
    }
    public function toggleAddForm()
    {
        $this->type = '';
        $this->particular_details = '';
        $this->courier_type = '';
        $this->tracking_no = '';
        $this->delivery_status = '';
        $this->remarks = '';
        $this->formType = '';

        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;

    }

    public function render()
    {
        $this->records = CourierRecord::where('form_type', 'like', '%' . $this->s_formType . '%')
        ->where('tracking_no', 'like', '%' . $this->s_tracking_no . '%')
        ->where('delivery_status', 'like', '%' . $this->s_delivery . '%')->where('particular_details', 'like', '%' . $this->search . '%')
        ->orderBy('id', 'desc')->get();
        return view('livewire.courierdetails');
    }
}
