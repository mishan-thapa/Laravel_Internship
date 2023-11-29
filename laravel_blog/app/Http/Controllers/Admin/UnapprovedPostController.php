<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginValidateRequest;

class UnapprovedPostController extends Controller
{
    public function index(){
        $posts = Post::where("status",'=','unapproved')->get();
        return view("admin.unapprovedPost", ["posts" => $posts]);
    }
    public function update(string $id){
        $post = Post::where('id','=',$id)
                    ->update(['status'=>'approved']);
        return redirect()->back();
    }
    public function delete(string $id){
        $post = Post::where('id','=',$id);
        $post->delete();
        return redirect()-back();
    }
}
