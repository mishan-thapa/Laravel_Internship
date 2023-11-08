<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//
use App\Models\User;
use App\Notifications\WelcomeNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function index(){
        $user=User::first();
        Notification::send($user,new WelcomeNotification($user->name));
        dd("email sent in real time ");
        //return view('welcome');
    }
}
