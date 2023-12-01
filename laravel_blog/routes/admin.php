<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\UnapprovedPostController;

Route::get('/',[AdminController::class,'login'])->name('admin.login')->middleware(['admin.guest']);
Route::post('/',[AdminController::class,'authenticateLogin'])->name('admin.authenticateLogin');
Route::get('/index',[AdminController::class,'index'])->name('admin.index')->middleware(['admin.auth']);
Route::post('/logout',[AdminController::class,'logout'])->name('admin.logout');
Route::delete('/post/delete/{id}',[AdminController::class,'delete'])->name('admin.post.delete')->middleware(['admin.auth']);

Route::get('/users',[AdminUserController::class,'index'])->name('admin.user.index');
Route::delete('/user/delete/{id}',[AdminUserController::class,'delete'])->name('admin.user.delete')->middleware(['admin.auth']);

Route::get('/approvedposts',[UnapprovedPostController::class,'index'])->name('admin.unapproved.index')->middleware(['admin.auth']);
Route::post('/update/{id}',[UnapprovedPostController::class,'update'])->name('admin.unapproved.update')->middleware(['admin.auth']);
Route::delete('/delete/{id}',[UnapprovedPostController::class,'delete'])->name('admin.unapproved.delete')->middleware(['admin.auth']);
