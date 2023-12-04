<?php

namespace App\Repositories;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{

    public function allUser(){
        return User::all();
    }

    public function createUser($validated_data){
        User::create($validated_data);
    }

    public function deleteUser($id){
        User::where('id','=',$id)->delete();
    }

    public function submitForgetPasswordForm($validated_data){
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $validated_data['email'],
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('emails.forgetPassword', ['token' => $token], function ($message) use($validated_data) {
            $message->to($validated_data['email']);
            $message->subject('Reset Password');
        });
    }

    public function submitResetPasswordForm($validated_data,$token){
        $updatePassword = DB::table('password_reset_tokens')
            ->where([
            'email' => $validated_data['email'],
            'token' => $token
            ])
            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = User::where('email', $validated_data['email'])
                    ->update(['password' => Hash::make($validated_data['password'])]);

        DB::table('password_reset_tokens')->where(['email'=> $validated_data['email']])->delete();
    }
}
