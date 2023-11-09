<?php

use Illuminate\Support\Facades\Route;
//
use App\Http\Controllers\NotificationController;


Route::get('/send_mail', [NotificationController::class,'index']);
Route::get('/',function(){
    return view('welcome');
});