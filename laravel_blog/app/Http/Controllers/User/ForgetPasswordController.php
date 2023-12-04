<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ForgetPasswordFormValidation;
use App\Http\Requests\ResetPasswordFormValidation;
use App\Repositories\Interfaces\UserRepositoryInterface;

class ForgetPasswordController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    //shows the view to input email
    public function index(){
        return view('users.forgetPassword');
    }

    //sends the password reset mail to the email
    public function create(ForgetPasswordFormValidation $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);
        $validated_data = $request->validated();
        $this->userRepository->submitForgetPasswordForm($validated_data);
        return redirect()->back()->with('success','we have sent you email to reset password');
    }

    public function edit($token){
        return view('users.resetPassword', compact('token'));
    }

    public function update(ResetPasswordFormValidation $request){
        $validated_data = $request->validated();
        $token = $request->token;
        $this->userRepository->submitResetPasswordForm($validated_data,$token);

        return redirect(route('users.index'))->with('message', 'Your password has been changed!');
    }
}
