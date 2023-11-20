<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/blog',[BlogController::class,'index'])->name('blogs.index');
Route::get('/blog/create',[BlogController::class, 'create'])->name('blogs.create');
Route::post('/blog', [BlogController::class, 'store'])->name('blogs.store');


Route::get('/blog/login',[UserController::class,'index'])->name('users.index');
Route::post('/blog/login',[UserController::class,'login'])->name('users.login');
Route::get('/blog/register',[UserController::class,'create'])->name('users.create');
Route::post('/blog/register',[UserController::class,'store'])->name('users.store');
Route::get('/blog/logout',[UserController::class,'logout'])->name('users.logout');