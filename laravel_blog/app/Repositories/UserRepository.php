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

    public function generateTwoFactorCode($validated_data)
    {
        $twoFactorCode = rand(100000, 999999);
        if(DB::table('two_factor_verifications')->where('email',$validated_data['email'])->exists()){
            DB::table('two_factor_verifications')->where(['email'=>$validated_data['email']])->delete();
        }
        DB::table('two_factor_verifications')->insert([
            'email' => $validated_data['email'],
            'two_factor_code' => $twoFactorCode,
            'two_factor_expires_at' => now()->addMinutes(10),
            'created_at' => Carbon::now(),
        ]);
        return $twoFactorCode;
    }

    public function getTwoFactorCode($email){
        $value = DB::table('two_factor_verifications')
            ->where('email', '=', $email)
            ->value('two_factor_code');
        return $value;
    }

    public function resetTwoFactorCode($email)
    {
        DB::table('two_factor_verifications')->where(['email'=>$email])->delete();
    }

    public function mailTwoFactorCode($validated_data,$twoFactorCode){
        Mail::send('emails.twoFactorCode', ['twoFactorCode' => $twoFactorCode], function ($message) use($validated_data) {
            $message->to($validated_data['email']);
            $message->subject('Two Factor Code');
        });
    }

    public function verifyTwoFactorCode($twoFactorCode,$email)
    {
        $true_two_factor_code = $this->getTwoFactorCode($email);
        if($twoFactorCode == $true_two_factor_code){
            $this->resetTwoFactorCode($email);
            return true;
        }else{
            return false;
        }
    }

}
