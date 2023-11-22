<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function validateLogin(){
        //form validation
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        //user authentication
        if(Auth::attempt($request->only('email','password'))){
            $request->session()->regenerate();
            $user = Auth::user();
            // Redirect the authenticated user to view their posts
            return redirect()->route('blogs.index');
        }

        return redirect('users.index')->withError('Login details are not valid');
    }
    public function register(){
        return view('admin.register');
    }
}
