<?php

namespace App\Http\Controllers;

use App\Models\Associate;
use App\Models\Cousre;
use App\Models\Students;
use App\Models\University;
use Illuminate\Http\Request;
use app\Models\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        $universityCount = University::count();
        $associateCount = Associate::count();
        $studentCount = Students::count();
        $courses = Cousre::count();
        $data = [
            'universityCount' => $universityCount,
            'associateCount' => $associateCount,
            'studentCount' => $studentCount,
            'courses' => $courses,
        ];
        
        return view('admin.home',['universityCount'=>$universityCount,'associateCount'=>$associateCount,'studentCount'=>$studentCount,'courses'=>$courses]);

    }
    public function usercreate()
    {
        return view('user.login');
    }

    public function userstore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'usertype' => 'associate'])) {

            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }else{
            session()->flash('error', 'Email and Password not matched');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function admincreate()
    {
        return view('auth.login');
    }

    public function adminstore(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'usertype' => 'admin'])) {
            $request->session()->regenerate();
           
           
            return redirect()->intended('/home  ');
        }else{
            session()->flash('error', 'Email and Password not matched');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
    public function staffstore(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'usertype' => 'staff'])) {
            $request->session()->regenerate();
           
           
            return redirect()->intended('/home  ');
        }else{
            session()->flash('error', 'Email and Password not matched');
        }

        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }
     public function staffcreate()
    {
        return view('staff.login');
    }
}
