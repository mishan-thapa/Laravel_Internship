<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function login(){
        return view('admin.login');
    }

    public function authenticateLogin(Request $request){
        //form validation
        $request->validate([
            "email" => "required",
            "password" => "required",
        ]);
        //user authentication
        if (Auth::guard('admin')->attempt($request->only("email", "password"))) {
            return redirect()->route("admin.dashboard");
        }

        return redirect("admin.login")->withError(
            "Login details are not valid"
        );
    }
    public function register(){
        return view('admin.register');
    }

    //to register the admin credentials
    public function store(Request $request){
        $data = $request->validate([
            "name" => "required",
            "email" => "required|unique:admins",
            "password" => "required|confirmed", //password and confirm_password must match
        ]);
        //create a new record of user in database
        Admin::create([
            "name" => $request->name,
            "email" => $request->email,
            //"password" => $request->password,
            'password' => \Hash::make($request->password),
        ]);

        return redirect(route("admin.index"));
    }

    public function logout(){
        \Session::flush();
        \Auth::guard('admin')->logout();
        //$request->session()->invalidate();
        return redirect(route("admin.index"));
    }

    public function dashboard(){
        return view('admin.dashboard');
    }

}
