<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController as ControllersDashboardController;
use App\Http\Controllers\LocationRackController;
use App\Http\Controllers\SearchBookController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;
use App\Http\Controllers\Student\LoginController;
use App\Http\Controllers\Student\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Teacher\LoginController as TeacherLoginController;
use App\Http\Controllers\Student\StudentRegisterController;
use App\Http\Controllers\Teacher\TeacherRegisterController;
use App\Http\Controllers\Teacher\DashboardController as TeacherDashboardController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [LoginController::class, 'loginForm']);
Route::post('/',[LoginController::class, 'store'])->name('student.login');

// Student
Route::get('/studentRegister', [StudentRegisterController::class, 'create'])->name('student.register');
Route::post('/studentRegister', [StudentRegisterController::class, 'store'])->name('student.register.post');

// Teacher
Route::get('/teacherRegister', [TeacherRegisterController::class, 'create'])->name('teacher.register');
Route::post('/teacherRegister', [TeacherRegisterController::class, 'store'])->name('teacher.register.post');


// student controller
Route::group(['prefix' => 'student', 'middleware' => ['auth:student']], function(){
    Route::get('/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/issue/book', [StudentDashboardController::class, 'issueBook'])->name('student.issue.book');
    Route::post('logout', [LoginController::class, 'destroy'])->name('student.logout');
    Route::get('/search/book',[SearchBookController::class, 'index'])->name('search.book');
    Route::post('/search/book',[SearchBookController::class, 'search'])->name('search.book');
    Route::post('/book/issue',[SearchBookController::class, 'issueBook'])->name('issue.book');
    Route::get('/successful',function(){
        return Inertia::render('Student/IssuedConfirm');
    })->name('success');
    Route::get('/profile', [ProfileController::class, 'index'])->name('student.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('student.profile.update');
    Route::post('/profile/change/password', [ProfileController::class, 'changePassword'])->name('student.profile.change.password');
});

// teacher controller
Route::group(['prefix' => 'teacher', 'middleware' => ['auth:teacher']], function(){
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/issue/book', [TeacherDashboardController::class, 'issueBook'])->name('teacher.issue.book');
    Route::post('logout', [LoginController::class, 'destroy'])->name('teacher.logout');
    Route::get('/search/book',[SearchBookController::class, 'index'])->name('search.book');
    Route::post('/search/book',[SearchBookController::class, 'search'])->name('search.book');
    Route::post('/book/issue',[SearchBookController::class, 'issueBook'])->name('issue.book');
    Route::get('/successful',function(){
        return Inertia::render('Teacher/IssuedConfirm');
    })->name('success');
    Route::get('/profile', [ProfileController::class, 'index'])->name('teacher.profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('teacher.profile.update');
    Route::post('/profile/change/password', [ProfileController::class, 'changePassword'])->name('teacher.profile.change.password');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth','verified']], function(){
    Route::get('/dashboard', [ControllersDashboardController::class, 'index'])->name('dashboard');
    Route::resource('category',CategoryController::class);
    Route::resource('author',AuthorController::class);
    Route::resource('location',LocationRackController::class);
    Route::resource('book', BookController::class);
    Route::resource('teacher', TeacherController::class);
    Route::resource('student', StudentController::class);
    Route::get('/issue/book/',[BookIssueController::class, 'indexTeacher'])->name('book.issueTeacher');
    Route::get('/issue/book/student',[BookIssueController::class, 'indexStudent'])->name('book.issueStudent');
    Route::get('/issue/book/{id}',[BookIssueController::class, 'view'])->name('book.issue.view');
    Route::post('/issue/book/status/{id}',[BookIssueController::class, 'statusUpdate'])->name('book.issue.status');
    Route::post('/issue/book/returned/{id}',[BookIssueController::class, 'returnUpdate'])->name('book.issue.return');
    Route::post('/issue/book',[BookIssueController::class, 'search']);
    Route::get('/setting',[SettingController::class,'index'])->name('settings');
    Route::post('/setting',[SettingController::class,'store'])->name('settings');
});

require __DIR__.'/auth.php';
