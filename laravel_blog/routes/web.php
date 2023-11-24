<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovedPostController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/blog',[BlogController::class,'index'])->name('blogs.index');
Route::get('/blog/create',[BlogController::class, 'create'])->name('blogs.create')->middleware(['auth']);
Route::post('/blog', [BlogController::class, 'store'])->name('blogs.store');
Route::get('/blog/post',[BlogController::class,'show'])->name('blogs.show')->middleware(['auth']);
Route::get('/blog/post/edit/{id}',[BlogController::class,'edit'])->name('blogs.edit')->middleware(['auth']);
Route::post('/blog/post/update/{id}',[BlogController::class,'update'])->name('blogs.update');
Route::delete('/blog/post/delete/{id}',[BlogController::class,'delete'])->name('blogs.delete')->middleware(['auth']);


Route::get('/blog/login',[UserController::class,'index'])->name('users.index')->middleware(['guest']);
Route::post('/blog/login',[UserController::class,'login'])->name('users.login');
Route::get('/blog/register',[UserController::class,'create'])->name('users.create')->middleware(['guest']);
Route::post('/blog/register',[UserController::class,'store'])->name('users.store');
Route::post('/blog/logout',[UserController::class,'logout'])->name('users.logout');


Route::get('/blog/admin',[AdminController::class,'login'])->name('admin.login');
Route::post('/blog/admin',[AdminController::class,'authenticateLogin'])->name('admin.authenticateLogin');
Route::get('/blog/admin/index',[AdminController::class,'index'])->name('admin.index')->middleware(['admin.auth']);
Route::get('/blog/admin/approve-posts',[AdminController::class,'show'])->name('admin.show')->middleware(['admin.auth']);
Route::get('blog/admin/update/{id}',[AdminController::class,'update'])->name('admin.update')->middleware(['admin.auth']);
Route::delete('/blog/admin/delete/{id}',[AdminController::class,'delete'])->name('admin.delete')->middleware(['admin.auth']);
Route::post('/blog/admin/logout',[AdminController::class,'logout'])->name('admin.logout');

