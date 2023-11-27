<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginValidateRequest;

class AdminController extends Controller
{
    public function index(){
        //$adminUser = Auth::guard('admin')->user();
        //$adminName = $adminUser->name;
        //return view('admin.index',['adminName'=>$adminName]);
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('admin.index',['posts'=>$posts]);
    }

    public function login(){
        return view('admin.login');
    }

    public function authenticateLogin(LoginValidateRequest $request){
        //user authentication
        if (Auth::guard('admin')->attempt($request->only("email", "password"))) {
            return redirect()->route("admin.index");
        }
        return redirect(route("admin.login"))->withError(
            "Login details are not valid"
        );
    }

    public function show(){
        $posts = Post::where("status",'=','unapproved')->get();
        return view("admin.show", ["posts" => $posts]);
    }

    public function update(string $id){
        $post = Post::where('id','=',$id)
                    ->update(['status'=>'approved']);
        return redirect()->back();
    }

    public function delete(string $id){
        $post = Post::where('id','=',$id);
        $post->delete();
        return redirect(route('admin.index'));
    }

    public function logout(){
        \Session::flush();
        Auth::guard('admin')->logout();
        //$request->session()->invalidate();
        return redirect(route("admin.login"));
    }

    public function userList(){
        $users = User::all();
        return view('admin.userList',['users'=>$users]);
    }

    public function deleteUser(string $id){
        $user = User::where('id','=',$id);
        $user->delete();
        return redirect()->back();
    }
}
