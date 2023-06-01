<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\WorkController;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    // log in
    Route::get('/', 'loginPage')->name('loginPage');
    Route::post('/log', 'authenticate')->name('login');
    // log out
    Route::get('/logout', 'logout')->name('logout');
    
});


Route::middleware(['auth','admin'])->group(function () {
    Route::get('admin/createGroup',[GroupController::class,'createGroupPage'])->name('createGroupPage');
    Route::post('admin/createGroup',[GroupController::class,'createGroup'])->name('createGroup');
    
    Route::get('admin/home',function(){
        return view('admin.home');
    })->name('admin.home');
    
    Route::get('admin/createSubject',[SubjectController::class,'createSubjectPage'])->name('createSubjectPage');
    Route::post('admin/createSubject',[SubjectController::class,'createSubject'])->name('createSubject');

    
    Route::get('admin/createTeacherToSub',[TeacherController::class,'createTeacherToSubPage'])->name('createTeacherToSubPage');
    Route::post('admin/createTeacherToSub',[TeacherController::class,'createTeacherToSub'])->name('createTeacherToSub');
    // create Teacher 
    Route::get('admin/createTeacher',[TeacherController::class,'createTeacherPage'])->name('createTeacherPage');
    Route::post('admin/createTeacher',[TeacherController::class,'createTeacher'])->name('createTeacher');

    
    Route::get('admin/createStudent',[StudentController::class,'createStudentPage'])->name('createStudentPage');
    Route::post('admin/createStudent',[StudentController::class,'createStudent'])->name('createStudent');
});
Route::controller(TeacherController::class)->middleware(['auth','teacher'])->group(function () {
    Route::get('teacher/home','teacherHome')->name('teacher.home');
    // profiel
    Route::get('/teacher/profile','teacherProfile')->name('teacher.profile');
    Route::post('/teacher/update','profileUpdate')->name('teacher.update');

    
    // check
    Route::get('teacher/check/{g_id}/{s_id}','checkPage')->name('teacher.checkPage');
    Route::post('teacher/check','check')->name('teacher.check');
    
    Route::post('teacher/topic','topic')->name('topic');
    
});
Route::controller(StudentController::class)->middleware(['auth','student'])->group(function () {
    Route::get('/student/home','StudentHome')->name('student.home');
    // profiel
    Route::get('/student/profile','studentProfile')->name('student.profile');
    Route::post('/student/update','profileUpdate')->name('student.update');
    // work
    Route::get('student/work/{s_id}','workPage')->name('student.work');
    Route::post('student/work','work')->name('student.workUpload');
    
});


