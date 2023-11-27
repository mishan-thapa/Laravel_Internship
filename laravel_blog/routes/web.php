<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApprovedPostController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/blog',[PostController::class,'index'])->name('post.index');
Route::get('/blog/create',[PostController::class, 'create'])->name('post.create')->middleware(['auth']);
Route::post('/blog', [PostController::class, 'store'])->name('post.store');
Route::get('/blog/post',[PostController::class,'show'])->name('post.show')->middleware(['auth']);
Route::get('/blog/post/edit/{id}',[PostController::class,'edit'])->name('post.edit')->middleware(['auth']);
Route::post('/blog/post/update/{id}',[PostController::class,'update'])->name('post.update');
Route::delete('/blog/post/delete/{id}',[PostController::class,'delete'])->name('post.delete')->middleware(['auth']);


Route::get('/blog/user/login',[UserController::class,'index'])->name('users.index')->middleware(['user.guest']);
Route::post('/blog/user/login',[UserController::class,'login'])->name('users.login');
Route::get('/blog/user/register',[UserController::class,'create'])->name('users.create')->middleware(['user.guest']);
Route::post('/blog/user/register',[UserController::class,'store'])->name('users.store');
Route::post('/blog/user/logout',[UserController::class,'logout'])->name('users.logout');
Route::delete('/blog/user/delete/{id}',[UserController::class,'delete'])->name('users.delete');


Route::get('/blog/admin',[AdminController::class,'login'])->name('admin.login')->middleware(['admin.guest']);
Route::post('/blog/admin',[AdminController::class,'authenticateLogin'])->name('admin.authenticateLogin');
Route::get('/blog/admin/index',[AdminController::class,'index'])->name('admin.index')->middleware(['admin.auth']);
Route::get('/blog/admin/approve-posts',[AdminController::class,'show'])->name('admin.show')->middleware(['admin.auth']);
Route::post('blog/admin/update/{id}',[AdminController::class,'update'])->name('admin.update')->middleware(['admin.auth']);
Route::delete('/blog/admin/delete/{id}',[AdminController::class,'delete'])->name('admin.blog.delete')->middleware(['admin.auth']);
Route::post('/blog/admin/logout',[AdminController::class,'logout'])->name('admin.logout');
Route::get('/blog/admin/users',[AdminController::class,'userList'])->name('admin.userList');
