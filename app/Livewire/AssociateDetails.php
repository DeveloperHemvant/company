<?php
namespace App\Livewire;
use App\Models\Students;
use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;
use App\Mail\Associate;
use Mail;
use App\Exports\AssociateExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Attributes\On;
class AssociateDetails extends Component
{
    use WithPagination;
    public $showAddForm = false;
    public $search = '';
    public function toggleAddForm()
    {
        $this->name = '';
        $this->showAddForm = !$this->showAddForm;
        $this->showEditForm = false;
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->address = '';
        $this->password = '';
        $this->pname = '';
        $this->smobile = '';
    }
    public $name;
    public $pname;
    public $smobile;
    public $email;
    public $mobile;
    public $address;
    public $password;
    public $updatename = '';
    public $showEditForm = false;
    public $id;
    public $landmobile;
    public $city;
    public $state;
    public $pincode;
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->address = $user->address;
        $this->city = $user->city;
        $this->pincode = $user->pincode;
        $this->state = $user->state;
        $this->smobile = $user->smobile;
        $this->landmobile = $user->landmobile;
            $this->pname = $user->pname;
        $this->showAddForm = false;
        $this->showEditForm = true;
    }
    public $postIdToDelete;
    public function confirmDelete($postId)
    {
        $this->postIdToDelete = $postId;
        $this->dispatch('delete');
    }
    #[On('goOn-Delete')]
    public function delete()
    {
        $associate =  User::with('students')->findOrFail($this->postIdToDelete);
        if ($associate->students->count()) {
        $this->dispatch('alert', [
            'type' => 'warning',
            'title' => 'Warning',
            'position' => 'center',
            'text' => 'Please delete all the related data regarding this Associate first.'
        ]);
    } else {
        $associate->delete();

        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Success',
            'position' => 'center',
            'text' => 'Associate deleted successfully.'
        ]);
    }
    }
    public function update()
    {
        $user = User::find($this->id);
        $student = Students::where('user_id', $this->id)->first();
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'address' => 'required',
            'city' => 'required',
            'pincode' => 'required',
            'state' => 'required',
            'pname' => 'required',
        ];
        if ($user && $this->email !== $user->email) {
            $rules['email'] .= '|unique:users,email';
        }
        $validatedData = $this->validate($rules, [
            'name.required' => 'The associate name is required.',
            'name.min' => 'The associate name must be at least 3 characters.',
            'email.required' => 'The associate email is required.',
            'email.email' => 'The associate email must be a valid email address.',
            'email.unique' => 'The associate email has already been taken.',
            'mobile.required' => 'The Mobile Number is required.',
            'address.required' => 'The Address is required.',
            'city.required' => 'The associate city is required.',
            'pincode.required' => 'The associate pincode is required.',
            'state.required' => 'The associate state is required.',
            'pname.required' => 'The associate pname is required.',
        ]);
        if ($student) {
            $student->update(['associate' => $validatedData['name']]);
        }
        if ($user) {
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->city = $validatedData['city'];
            $user->mobile = $validatedData['mobile'];
            $user->address = $validatedData['address'];
            $user->pincode = $validatedData['pincode'];
            $user->state = $validatedData['state'];
            $user->pname = $validatedData['pname'];
            $user->smobile =$this->smobile;
            $user->landmobile = $this->landmobile;
            $user->save();
            session()->flash('status', 'Associate updated successfully');
        } else {
            session()->flash('status', 'Failed to update associate');
        }
        $this->showEditForm = false;
    }
    public function save()
    {
        $validatedData = $this->validate([
            'name' => [
                'required',
                'string',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'email' => 'required|email|unique:users,email',
             'mobile' => 'required|digits:10',
            'address'=>'required',
            'password' => [
                'required',
                'string',
                'min:8',            
                'regex:/[a-z]/',      
                'regex:/[A-Z]/',      
                'regex:/[0-9]/',      
                'regex:/[@$!%*?&#]/' 
            ],
            'city'=>'required',
            'pincode'=>'required|digits:6',
            'state'=>'required',
            'pname'=>'required|string',
        ], [
            'name.required' => 'The associate name is required.',
            'name.min' => 'The associate name must be at least 3 characters.',
            'name.unique' => 'The associate name has already been taken.',
            'email.required' => 'The associate email is required.',
            'city.required' => 'The associate city is required.',
            'pincode.required' => 'The associate pincode is required.',
            'state.required' => 'The associate state is required.',
            'pname.required' => 'The associate pname is required.',
            'email.email' => 'The associate email must be a valid email address.',
            'email.unique' => 'The associate email has already been taken.',
            'mobile.required' => 'The Mobile Number is required.',
            'address.required' => 'The Address is required.',
            'password.required' => 'The password is required.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        ]);
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->city = $validatedData['city'];
        $user->mobile = $validatedData['mobile'];
        $user->password = $validatedData['password'];
        $user->address = $validatedData['address'];
        $user->pincode = $validatedData['pincode'];
        $user->state = $validatedData['state'];
        $user->pname = $validatedData['pname'];
        $user->smobile =$this->smobile;
        $user->landmobile = $this->landmobile;
        if ($user->save()) {
            session()->flash('status', 'Associate created successfully');
            Mail::to($validatedData['email'])->send(new Associate($validatedData));
        } else {
            session()->flash('status', 'Associate Not created');
        }
        $this->resetForm();
        $this->showAddForm = false;
    }
    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->address = '';
        $this->password = '';
        $this->city = '';
        $this->pincode = '';
        $this->state = '';
        $this->pname = '';
        $this->smobile ='';
        $this->landmobile = '';
    }
    public function export(){
        $export = User::where('usertype', '=', 'associate')->where('name', 'like', '%' . $this->search . '%')->where('email', 'like', '%' . $this->search . '%')->get();
        return Excel::download(new AssociateExport($export), 'associate.xlsx');
    }
    public function render()
    {
        $data = User::where('usertype', '=', 'associate')->where('name', 'like', '%' . $this->search . '%')->where('email', 'like', '%' . $this->search . '%')->paginate(10);
        return view('livewire.associate-details', ['data' => $data]);
    }
}
