<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('welcome');
});

//for student CRUD operation
Route::get('/student', [StudentController::class, 'index'])->name('student.index');
Route::get('/student/create',[StudentController::class, 'create'])->name('student.create');
Route::post('/student',[StudentController::class,'store'])->name('student.store');
Route::get('/student/edit/{id}',[StudentController::class,'edit'])->name('student.edit');
Route::put('student/update/{id}',[StudentController::class,'update'])->name('student.update');
Route::delete('/destroy/{id}', [StudentController::class, 'destroy'])->name('student.destroy');