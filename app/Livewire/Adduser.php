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

class Adduser extends Component
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
    
    }

    public $name;
    public $email;
    public $mobile;
    public $address;
    public $password;
    public $updatename = '';
    public $showEditForm = false;
    public $id;
    public $usertype;
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->id = $id;
        // dd($user);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->address = $user->address;
        $this->showAddForm = false;
        $this->showEditForm = true;
    }
    public function delete($id)
    {
        $associate = User::find($id)->delete();
    }
    public function update()
    {
        $user = User::find($this->id);
        $student = Students::where('user_id',$this->id)->get();
        // dd($student);
        $rules = [
            'name' => 'required|min:3',
            'email' => 'required|email',
            'mobile' => 'required|digits:10',
            'address' => 'required',
            
        ];
        
    if ($user && $this->email !== $user->email) {
        $rules['email'] .= '|unique:users,email';
    }
    $validatedData = $this->validate($rules, [
        'name.required' => 'The User name is required.',
        'name.min' => 'The User name must be at least 3 characters.',
        'email.required' => 'The User email is required.',
        'email.email' => 'The User email must be a valid email address.',
        'email.unique' => 'The User email has already been taken.',
        'mobile.required' => 'The Mobile Number is required.',
        'address.required' => 'The Address is required.',
        
    ]);
        // dd($validatedData);
        if ($student) {
            Students::where('user_id', $this->id)->update(['associate' => $validatedData['name']]);
        }
    if ($user) {
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'mobile'=>$validatedData['mobile'],
            'address'=>$validatedData['address'],
        ]);
        session()->flash('status', 'User updated successfully');
    } else {
        session()->flash('status', 'Failed to update associate');
    }
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
        ], [
            'name.required' => 'The User name is required.',
            'name.min' => 'The User name must be at least 3 characters.',
            'name.unique' => 'The User name has already been taken.',
            'email.required' => 'The User email is required.',
            'email.email' => 'The User email must be a valid email address.',
            'email.unique' => 'The User email has already been taken.',
            'mobile.required' => 'The Mobile Number is required.',
            'address.required' => 'The Address is required.',
            'password.required' => 'The password is required.',
            'password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character.',
        ]);
        $this->usertype = 'staff';

// If the usertype is provided in the form, override the default value
if(isset($this->usertype)) {
    $validatedData['usertype'] = $this->usertype;
}
        $user = new User;
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->mobile = $validatedData['mobile'];
        $user->address = $validatedData['address'];
        $user->password = $validatedData['password'];
        $user->usertype = "staff";
        if ($user->save()) {
            session()->flash('status', 'User created suucessfully');
            Mail::to($validatedData['email'])->send(new Associate($validatedData));
        } else {
            session()->flash('status', 'User Not created');
        }
        $this->name = '';
        $this->email = '';
        $this->mobile = '';
        $this->address = '';
        $this->password = '';
    
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
    }
    public function render()
    {
        $data = User::where('usertype', '=', 'staff')->paginate(10);
        return view('livewire.adduser', ['data' => $data]);
    }
}