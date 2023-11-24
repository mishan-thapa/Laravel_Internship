<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class ApprovedPostController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->get();;
        return view('admin.approvePost',['posts'=>$posts]);
    }

    public function update(Request $request, string $id){
        $post = Post::where('id','=',$id)
                    ->update(['status'=>'approved']);
        return redirect()->back();
    }
}
