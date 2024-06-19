<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Livewire\Frontend\About;
Route::prefix('')->group(function () {
    Route::view('/', 'frontend/home')->name('home');
    Route::view('/career', 'frontend/career')->name('career');
    Route::view('/about', 'frontend/about')->name('about');
    Route::view('/contact', 'frontend/contact')->name('contact');
    Route::view('/campus-admission', 'frontend/campus-admission')->name('campus-admission');
    Route::view('/online-courses', 'frontend/online-course')->name('online-courses');
    Route::view('/distance-learning', 'frontend/distance-learning')->name('distance-learning');
    Route::view('/phd-admission', 'frontend/phd-admission')->name('phd-admission');
    Route::view('/thesis-writing', 'frontend/thesis-writing')->name('thesis-writing');
    Route::view('/proof-reading', 'frontend/proof-reading')->name('proof-reading');
    Route::view('/plagrim', 'frontend/plagrim')->name('plagrim');
    Route::view('/journal', 'frontend/journal')->name('journal');
    Route::view('/blog', 'frontend/blog')->name('blog');
    Route::view('/terms', 'frontend/terms')->name('terms');
    Route::view('/privacypolicy', 'frontend/privacypolicy')->name('privacypolicy');
    Route::view('/refund', 'frontend/refund')->name('refund');
});













//////////BCKEND Routes///////
Route::get('/login/user', [AdminController::class, 'usercreate'])
    ->name('login.user');
Route::post('/login/user', [AdminController::class, 'userstore']);

Route::get('/admin/login/', [AdminController::class, 'admincreate'])
    ->name('login.admin');
Route::post('/admin/login', [AdminController::class, 'adminstore']);
Route::get('/create/staff', [AdminController::class, 'staffcreate'])->name('login.staff');
Route::post('/staff/login', [AdminController::class, 'staffstore']);

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

