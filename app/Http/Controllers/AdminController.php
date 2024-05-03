<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use app\Models\User;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
   public function index(){
        if (Auth::user()->usertype=='staff') {
           
            return view('dashboard');
        }else{
            // dd('admin');
            return view('admin.home');
        }
   }
}
