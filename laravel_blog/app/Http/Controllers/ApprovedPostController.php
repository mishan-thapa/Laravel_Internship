<?php

namespace App\Http\Controllers;

use App\Models\ApprovedPost;
use Illuminate\Http\Request;
use App\Models\Post;

class ApprovedPostController extends Controller
{
    public function index(){
        $posts = Post::orderBy('created_at', 'desc')->get();;
        return view('admin.approvePost',['posts'=>$posts]);
    }
}
