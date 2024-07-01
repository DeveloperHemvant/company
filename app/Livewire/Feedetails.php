<?php

namespace App\Livewire;
use App\Models\Feedetail;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeeDetailsExport;
use Livewire\Attributes\On;
use Livewire\WithPagination;

use Livewire\Component;

class Feedetails extends Component
{
    use WithPagination;
    public $deleteid;
    public $search = '';
    public $showAddForm = false;
    public $showEditForm = false;
    public $feeDetailId;
    public $date;
    public $feeDetails;
    public $received_from;
    public $received_amount;
    public $description;
    public $mode;
    public $remark;
    public $rsearch;
    protected $rules = [
        'date' => 'required|date',
        'received_from' => 'required|string|max:255',
        'received_amount' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'mode' => 'required|in:UPI,IMPS,NEFT,UNIVERSITY ACCOUNT,CASH',
        'remark' => 'nullable|string',
    ];
    public function mount()
    {
        $this->loadFeeDetails();
    }
    public function export()
    {
        return Excel::download(new FeeDetailsExport($this->feeDetails), 'fee_details.xlsx');
    }
    public function loadFeeDetails()
    {
        $this->feeDetails = FeeDetail::where('received_from', 'like', '%' . $this->search . '%')->where('received_from', 'like', '%' . $this->rsearch . '%')->orderBy('id', 'desc')->get();
    }
    public function save()
    {
        $this->validate();

        FeeDetail::create([
            'date' => Carbon::parse($this->date)->format('Y-m-d'),
            'received_from' => $this->received_from,
            'received_amount' => $this->received_amount,
            'description' => $this->description,
            'mode' => $this->mode,
            'remark' => $this->remark,
        ]);

        session()->flash('message', 'Fee detail saved successfully.');

        $this->reset();
        $this->showAddForm = false;
        $this->loadFeeDetails();
    }

    public function toggleAddForm()
    {
        $this->date = '';
        $this->received_from = '';
        $this->received_amount = '';
        $this->description = '';
        $this->mode = '';
        $this->remark = '';

        
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
        
        
    }
   

    // public function loadFeeDetails()
    // {
    //     $this->feeDetails = FeeDetail::all();
    // }
    public function edit($id)
    {
        $feeDetail = FeeDetail::findOrFail($id);
        $this->feeDetailId = $feeDetail->id;
        $this->date = $feeDetail->date;
        $this->received_from = $feeDetail->received_from;
        $this->received_amount = $feeDetail->received_amount;
        $this->description = $feeDetail->description;
        $this->mode = $feeDetail->mode;
        $this->remark = $feeDetail->remark;
        $this->showEditForm = true;
    }
    public function update()
    {
        $this->validate();

        $feeDetail = FeeDetail::findOrFail($this->feeDetailId);
        $feeDetail->update([
            'date' => $this->date,
            'received_from' => $this->received_from,
            'received_amount' => $this->received_amount,
            'description' => $this->description,
            'mode' => $this->mode,
            'remark' => $this->remark,
        ]);

        $this->resetForm();
        // $this->feeDetails = FeeDetail::all();

        session()->flash('message', 'Fee detail updated successfully.');
    }
    public function deleteconfirmation($id)
    {
        $this->deleteid = $id;
        $this->dispatch('delete');
        
    }
    #[On('goOn-Delete')]
    public function delete(){
        FeeDetail::find($this->deleteid)->delete();
    }

    public function resetForm()
    {
        $this->feeDetailId = null;
        $this->date = null;
        $this->received_from = null;
        $this->received_amount = null;
        $this->description = null;
        $this->mode = null;
        $this->remark = null;
        $this->showEditForm = false;
    }
    public function render()
    {
        // where(function ($query) {
        //     $query->where('mode', 'like', '%' . $this->search . '%')
        //         ->orWhere('father_name', 'like', '%' . $this->search . '%')
        //         ->orWhere('email_id', 'like', '%' . $this->search . '%');
        // })
        $this->feeDetails = FeeDetail::where('mode', 'like', '%' . $this->search . '%')->where('received_from', 'like', '%' . $this->rsearch . '%')->orderBy('id', 'desc')->get();
        return view('livewire.feedetails');
    }
}
