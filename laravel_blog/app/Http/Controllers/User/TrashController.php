<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class TrashController extends Controller
{
    public function index(){
        $user_id = Auth::user()->id;
        $posts = Post::onlyTrashed()->where('user_id','=',$user_id)->get();
        return view('trash.index',['posts'=>$posts]);
    }

    public function update(string $id){
        $post = Post::where('id','=',$id)->restore();
        return redirect()->back();
    }
    public function delete(string $id){
        $post = Post::where('id','=',$id)->forceDelete();
        return redirect()->back();
    }
}
