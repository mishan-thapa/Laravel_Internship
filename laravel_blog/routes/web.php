<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\ApprovedPostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\User\PostController;
use App\Http\Controllers\User\TrashController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\UnapprovedPostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/blog',[BlogController::class,'index'])->name('blog.index');

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

Route::get('/blog/admin',[AdminController::class,'login'])->name('admin.login')->middleware(['admin.guest']);
Route::post('/blog/admin',[AdminController::class,'authenticateLogin'])->name('admin.authenticateLogin');
Route::get('/blog/admin/index',[AdminController::class,'index'])->name('admin.index')->middleware(['admin.auth']);
Route::post('/blog/admin/logout',[AdminController::class,'logout'])->name('admin.logout');
Route::delete('/blog/admin/post/delete/{id}',[AdminController::class,'delete'])->name('admin.post.delete')->middleware(['admin.auth']);

Route::get('/blog/admin/users',[AdminUserController::class,'index'])->name('admin.user.index');
Route::delete('/blog/admin/user/delete/{id}',[AdminUserController::class,'delete'])->name('admin.user.delete')->middleware(['admin.auth']);

Route::get('/blog/admin/approvedposts',[UnapprovedPostController::class,'index'])->name('admin.unapproved.index')->middleware(['admin.auth']);
Route::post('blog/admin/update/{id}',[UnapprovedPostController::class,'update'])->name('admin.unapproved.update')->middleware(['admin.auth']);
Route::delete('/blog/admin/delete/{id}',[UnapprovedPostController::class,'delete'])->name('admin.unapproved.delete')->middleware(['admin.auth']);
