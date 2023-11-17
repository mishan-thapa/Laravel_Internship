<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});

//for todo application
Route::get('/todo', [TodoController::class, 'index'])->name('todo.index');
Route::get('/todo/create',[TodoController::class, 'create'])->name('todo.create');
Route::post('/todo',[TodoController::class,'store'])->name('todo.store');
Route::get('/todo/edit/{id}',[TodoController::class,'edit'])->name('todo.edit');
Route::put('todo/update/{id}',[TodoController::class,'update'])->name('todo.update');
Route::delete('/destroy/{id}', [TodoController::class, 'destroy'])->name('todo.destroy');