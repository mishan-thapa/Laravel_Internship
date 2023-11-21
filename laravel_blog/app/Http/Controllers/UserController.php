<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        return view('users.login');
    }

    public function create(){
        return view('users.register');
    }

    public function store(Request $request){
        //form validation
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password'=>'required|confirmed',//password and confirm_password must match
        ]);

        //create a new record of user in database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            //'password' => \Hash::make($request->password),
        ]);

        return redirect(route('users.index'));
    }

    public function login(Request $request){
        //form validation
        $request->validate([
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

    public function logout(Request $request){
        \Session::flush();
        \Auth::logout();
        $request->session()->invalidate();
        return redirect(route('blogs.index'));
    }
}
