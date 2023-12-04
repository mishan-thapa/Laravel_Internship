<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\BlogController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\TrashController;
use App\Http\Controllers\User\ForgetPasswordController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog',[BlogController::class,'index'])->name('blog.index');
Route::post('/blog/search',[BlogController::class,'search'])->name('blog.search');
Route::get('/blog/filterSearch',[BlogController::class,'filterSearchView'])->name('blog.filterSearchView');
Route::post('/blog/filterSearch',[BlogController::class,'filterSearch'])->name('blog.filterSearch');

Route::get('/blog/post',[PostController::class,'index'])->name('post.index');
Route::get('/blog/create',[PostController::class, 'create'])->name('post.create')->middleware(['auth']);
Route::post('/blog', [PostController::class, 'store'])->name('post.store');
Route::get('/blog/post/edit/{id}',[PostController::class,'edit'])->name('post.edit')->middleware(['auth']);
Route::post('/blog/post/update/{id}',[PostController::class,'update'])->name('post.update');
Route::delete('/blog/post/delete/{id}',[PostController::class,'delete'])->name('post.delete')->middleware(['auth']);


Route::get('/blog/trash',[TrashController::class,'index'])->name('trash.index')->middleware(['auth']);
Route::post('/blog/trash/restore/{id}',[TrashController::class,'update'])->name('trash.update')->middleware(['auth']);
Route::delete('/blog/trash/delete/{id}',[TrashController::class,'delete'])->name('trash.delete')->middleware(['auth']);

Route::get('/blog/user/login',[UserController::class,'index'])->name('users.index')->middleware(['user.guest']);
Route::post('/blog/user/login',[UserController::class,'login'])->name('users.login');
Route::get('/blog/user/register',[UserController::class,'create'])->name('users.create')->middleware(['user.guest']);
Route::post('/blog/user/register',[UserController::class,'store'])->name('users.store');
Route::post('/blog/user/logout',[UserController::class,'logout'])->name('users.logout');
Route::delete('/blog/user/delete/{id}',[UserController::class,'delete'])->name('users.delete');

Route::get('/blog/forget-passowrd',[ForgetPasswordController::class,'index'])->name('forgetPassword.index');
Route::post('/blog/forget-password',[ForgetPasswordController::class,'create'])->name('forgetPassword.create');
Route::get('/blog/reset-password/{token}',[ForgetPasswordController::class,'edit'])->name('forgetPassword.edit');
Route::post('/blog/reset-password',[ForgetPasswordController::class,'update'])->name('forgetPassword.update');
