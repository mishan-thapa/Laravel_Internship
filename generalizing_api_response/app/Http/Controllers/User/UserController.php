<?php

namespace App\Http\Controllers\User;

//use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class UserController extends ApiController
{

    public function index()
    {
        $user = User::all();
        return $this->successResponse($user);
    }

    public function store(Request $request)
    {
        $validator = $this->validateUser();
        if($validator->fails()){
            return $this->errorResponse($validator->messages(), 422);
        }

        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
        ]);

        return $this->successResponse($user,'User Created', 201);
    }

    public function show(string $id)
    {
        $user = User::find($id);
        return $this->successResponse($user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return $this->successResponse(null, 'User Deleted');
    }

    public function validateUser(){
        return Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

}