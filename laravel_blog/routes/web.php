<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/blog',[BlogController::class,'index'])->name('blogs.index');
Route::get('/blog/create',[BlogController::class, 'create'])->name('blogs.create')->middleware(['auth']);
Route::post('/blog', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blog/my-post',[BlogController::class,'show'])->name('blogs.show')->middleware(['auth']);
Route::get('/blog/my-post/edit/{id}',[BlogController::class,'edit'])->name('blogs.edit')->middleware(['auth']);
Route::post('/blog/my-post/update/{id}',[BlogController::class,'update'])->name('blogs.update');


Route::get('/blog/login',[UserController::class,'index'])->name('users.index')->middleware(['guest']);
Route::post('/blog/login',[UserController::class,'login'])->name('users.login');
Route::get('/blog/register',[UserController::class,'create'])->name('users.create')->middleware(['guest']);
Route::post('/blog/register',[UserController::class,'store'])->name('users.store');
Route::post('/blog/logout',[UserController::class,'logout'])->name('users.logout');


Route::get('/blog/admin',[AdminController::class,'index'])->name('admin.index');
Route::get('/blog/admin/login',[AdminController::class,'login'])->name('admin.login');
Route::post('/blog/admin/login',[AdminController::class,'validateLogin'])->name('admin.validateLogin');
Route::get('/blog/admin/register',[AdminController::class,'register'])->name('admin.register');
