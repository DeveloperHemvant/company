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
use App\Exports\UserExport;
use Maatwebsite\Excel\Facades\Excel;

class Adduser extends Component
{
    use WithPagination;
    public $role;
    public $search = '';
    public $u_search = '';

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
    public $is_admin;
    public $s_is_admin;
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->id = $id;
        // dd($user);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
        $this->address = $user->address;
        $this->s_is_admin = $user->role;
        // dd($this->s_is_admin);
        $this->showAddForm = false;
        $this->showEditForm = true;
    }
    #[On('goOn-Delete')]
    public function delete()
    {
        $associate = User::find($this->postIdToDelete)->delete();
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
            's_is_admin' => 'nullable|boolean',
            
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
        // dd($this->s_is_admin);
        $this->role = $this->s_is_admin ? 'admin' : 'user';
        // dd($this->role);
    if ($user) {
            $user->name = $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->mobile = $validatedData['mobile'];
            $user->address = $validatedData['address'];
            $user->role = $this->role;
            $user->save();
        
        session()->flash('status', 'User updated successfully');
    } else {
        session()->flash('status', 'Failed to update associate');
    }
        $this->showEditForm = false;
    }
    public $postIdToDelete;
    public function confirmDelete($postId)
    {
        $this->postIdToDelete = $postId;
        // dd($this->postIdToDelete);

        $this->dispatch('delete');
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
        // dd($this->is_admin);

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
        if($this->is_admin) {
            $user->role = "admin";
        }else{
            $user->role = 'user';
        }
        if ($user->save()) {
            session()->flash('status', 'User created successfully');
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
    public function export(){
        $Exportdata = User::where('usertype', '=', 'staff')->where('name', 'like', '%' . $this->search . '%')->where('role', 'like', '%' . $this->u_search . '%')->get();
        return Excel::download(new UserExport($Exportdata), 'user.xlsx');
    }
    public function render()
    {
        $data = User::where('usertype', '=', 'staff')->where('name', 'like', '%' . $this->search . '%')->where('role', 'like', '%' . $this->u_search . '%')->paginate(10);
        return view('livewire.adduser', ['data' => $data]);
    }
}
