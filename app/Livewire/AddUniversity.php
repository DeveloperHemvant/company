<?php

namespace App\Livewire;
use Livewire\WithPagination;
use Livewire\Attributes\Validate;
use Livewire\Component;
use App\Models\University;
use Livewire\Attributes\On;
use Illuminate\Validation\Rule;
use App\Exports\UniversitiesExport;
use Maatwebsite\Excel\Facades\Excel;


class AddUniversity extends Component
{
    use WithPagination;
    public $showAddForm = false;
    public $showEditForm = false;
    public $search ;
    public $filterdata;
    public $id;
    public function toggleAddForm()
    {
        $this->university_code = '';
        $this->university_name = '';

        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
        session()->forget('status');
    }
    #[Validate('required', message: 'Please provide University Name', translate: false)]
    public $university_name = '';
    #[Validate('required', message: 'Please provide University Code', translate: false)]
    public $university_code = '';

    public function save()
    {
        $validatedData = $this->validate([
            'university_name' => [
                'required',
                Rule::unique('universities')->whereNull('deleted_at'),
            ],
            'university_code' => [
                'required',
                Rule::unique('universities')->whereNull('deleted_at'),
            ],
        ]);
        // dd($validatedData);
        if (University::create($validatedData)) {
            session()->flash('status', 'Unversity created successfully');
        } else {
            session()->flash('status', 'University Not created');
        }
        $this->toggleAddForm();

        $this->resetForm();
    }
    public function edit($id)
    {
        $user = University::findOrFail($id);
        $this->id = $id;
        // dd($user);
        $this->university_name = $user->university_name;
        $this->university_code = $user->university_code;
        $this->showAddForm = false;
        $this->showEditForm = true;
    }
    public function update()
{
    $id = $this->id;
        // dd($id);
    $university = University::findOrFail($id);

    // Check if the university name and code are the same as the current values
    $nameChanged = $university->university_name !== $this->university_name;
    $codeChanged = $university->university_code !== $this->university_code;

    // Prepare the validation rules
    $validationRules = [];
    $validationMessages = [];

    if ($nameChanged) {
        $validationRules['university_name'] = [
            'required',
            'min:3',
            Rule::unique('universities', 'university_name')->ignore($id)
        ];
        $validationMessages['university_name.required'] = 'The university name is required.';
        $validationMessages['university_name.min'] = 'The university name must be at least 3 characters.';
        $validationMessages['university_name.unique'] = 'The university name has already been taken.';
    }

    if ($codeChanged) {
        $validationRules['university_code'] = [
            'required',
            'min:3',
            Rule::unique('universities', 'university_code')->ignore($id)
        ];
        $validationMessages['university_code.required'] = 'The university code is required.';
        $validationMessages['university_code.min'] = 'The university code must be at least 3 characters.';
        $validationMessages['university_code.unique'] = 'The university code has already been taken.';
    }

    // Validate only if there are validation rules
    if (!empty($validationRules)) {
        $validatedData = $this->validate($validationRules, $validationMessages);
    }

    // Update the university attributes
    $university->update([
        'university_name' => $this->university_name,
        'university_code' => $this->university_code,
    ]);

    $this->showEditForm = false;
    $this->resetForm();
}


    public function resetForm()
    {
        $this->university_name = '';
        $this->university_code = '';
    }
    // public function paginationView()
    // {
    //     return 'custom-pagination-links-view';
    // }
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

        $university = University::with('courses','students','admissionSessions')->find($this->postIdToDelete);
        // dd($university->courses->count());

    if ($university->courses->count() > 0 || 
        $university->students->count() > 0 || 
        $university->admissionSessions->count() > 0) {

        $this->dispatch('alert', [
            'type' => 'warning',
            'title' => 'Warning',
            'position' => 'center',
            'text' => 'Please delete all the related data regarding this University first.'
        ]);
    } else {
        $university->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Success',
            'position' => 'center',
            'text' => 'University deleted successfully.'
        ]);
    }


    }
    public function export(){
        $exportdata = University::where(function ($query) {
            $query->where('university_name', 'like', '%' . $this->search . '%')
                ->orWhere('university_code', 'like', '%' . $this->search . '%');
        })->get();
    
    return Excel::download(new UniversitiesExport($exportdata), 'universities.xlsx');
    }
    public function render()
    {
        $data = University::
        where(function ($query) {
            $query->where('university_name', 'like', '%' . $this->search . '%')
                ->orWhere('university_code', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'desc')->paginate(10);
        
        return view('livewire.add-university',['data' => $data]);
    }
}
