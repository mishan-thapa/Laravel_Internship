<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginValidateRequest;

class AdminUserController extends Controller
{
    public function index(){
        $users = User::all();
        return view('admin.userList',['users'=>$users]);
    }

    public function delete(string $id){
        $user = User::where('id','=',$id);
        $user->delete();
        return redirect()->back();
    }
}
