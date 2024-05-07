<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Livewire\EditUniversity;
Route::get('/', function () {
    return view('welcome');
});

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


// Route::get('/create-data', AddUniversity::class);
Route::get('/add-university', function () {
    return view('admin/adduniversity');
})->name('add-university');
Route::get('/all-university', function () {
    return view('admin/alluniversity'); 
})->name('all-university');

Route::get('/edit-university/{id}', function ($id) {
    return view('admin/edituniversity' ,['id' => $id]);
})->name('edit-university');
Route::get('/associate-details', function () {
    return view('admin/associate-details' );
})->name('all-associate');
Route::get('/session-details', function () {
    return view('admin/session-details' );
})->name('all-session');
Route::get('/specialization-details', function () {
    return view('admin/specialization' );
})->name('specialization-details');
Route::get('/course-details', function () {
        return view('admin/course-details');
    })->name('course-details');
});
Route::get('/add-student', function () {
    return view('admin/addstudent');
})->name('add-student');
