<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Livewire\EditUniversity;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/user/login', function () {
//     return view('user/login');
// })->name('userlogin');
Route::get('/login/user', [AdminController::class, 'usercreate'])
    ->name('login.user');
Route::post('/login/user', [AdminController::class, 'userstore']);

Route::get('/admin/login/', [AdminController::class, 'admincreate'])
    ->name('login.admin');
Route::post('/admin/login', [AdminController::class, 'adminstore']);
Route::get('/create/staff', [AdminController::class, 'staffcreate'])
    ->name('login.staff');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/home', [AdminController::class, 'index']);
    Route::get('/add-university', function () {
        return view('admin/adduniversity');
    })->name('add-university');
    Route::get('/all-university', function () {
        return view('admin/alluniversity');
    })->name('all-university');

    Route::get('/edit-university/{id}', function ($id) {
        return view('admin/edituniversity', ['id' => $id]);
    })->name('edit-university');
    Route::get('/associate-details', function () {
        return view('admin/associate-details');
    })->name('all-associate');
    Route::get('/session-details', function () {
        return view('admin/session-details');
    })->name('all-session');
    Route::get('/specialization-details', function () {
        return view('admin/specialization');
    })->name('specialization-details');
    Route::get('/course-details', function () {
        return view('admin/course-details');
    })->name('course-details');
    Route::get('/add-student', function () {
        return view('admin/addstudent');
    })->name('add-student');
    Route::get('/all-student', function () {
        return view('admin/allstudents');
    })->name('all-student');
    Route::get('/update-student/{id}', function ($id) {
        return view('admin/updatestudent', ['id' => $id]);
    })->name('update-student');
    Route::get('/add-user', function () {
        return view('user/adduser');
    })->name('add-user');
});

