<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\EmailOnlyValidationRequest;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface;

class TwoFactorVerificationController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function index(){
        return view('users.twoFactorEmailForm');
    }

    public function store(EmailOnlyValidationRequest $request){
        // Retrieve the validated input data...
        $validated_data = $request->validated();
        $email =$validated_data['email'];
        $twoFactorCode = $this->userRepository->generateTwoFactorCode($validated_data);
        $this->userRepository->mailTwoFactorCode($validated_data,$twoFactorCode);
        return view('users.otpForm',compact('email'));
    }

    public function edit(){
        return view('users.otpForm');
    }

    public function update(Request $request, string $email){
        $request->validate([
            'two_factor_code' => 'integer|required',
        ]);

        $twoFactorCode = $request->input('two_factor_code');
        $isSuccess = $this->userRepository->verifyTwoFactorCode($twoFactorCode,$email);
        if($isSuccess){
            return redirect()->route('users.create');
        }else{
            return redirect()->back()
            ->withErrors(['two_factor_code' =>
                'The two factor code you have entered does not match']);
        }
    }
}
