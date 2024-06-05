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
use Livewire\Attributes\On;
class AssociateDetails extends Component
{
    use WithPagination;

    public $showAddForm = false;
    public function toggleAddForm()
    {
        $name = '';
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
        // dd($user);
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
        // dd($associate->students->count());

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
        // Find the user by ID
        $user = User::find($this->id);
    
        // Find the associated student (if any)
        $student = Students::where('user_id', $this->id)->first();
    
        // Define validation rules
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
    
        // If the user exists and the email is being changed, add unique validation
        if ($user && $this->email !== $user->email) {
            $rules['email'] .= '|unique:users,email';
        }
    
        // Validate the request data
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
    
        // Update the associated student record, if exists
        if ($student) {
            $student->update(['associate' => $validatedData['name']]);
        }
    
        // Update the user record
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
    
        // Hide the edit form
        $this->showEditForm = false;
    }
    
    public function save()
    {
        $validatedData = $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'mobile'=>'required|digits:10',
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
            'pincode'=>'required',
            'state'=>'required',
            'pname'=>'required',
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
            session()->flash('status', 'Associate created suucessfully');
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
    public function render()
    {
        $data = User::where('usertype', '=', 'associate')->paginate(10);
        return view('livewire.associate-details', ['data' => $data]);
    }
}
