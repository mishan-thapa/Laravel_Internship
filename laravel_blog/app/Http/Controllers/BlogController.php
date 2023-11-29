<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class BlogController extends Controller
{
    use ApiResponser;
    // Show all posts
    public function index()
    {
        $posts = Post::where('status', '=', 'approved')
                    ->orderBy('created_at', 'desc')
                    ->paginate(5);//->get();
        //$response = $this->successResponse($posts);
        //return view('index',['responseData'=>$response]);
        return view("blog.index", compact('posts')); //["posts" => $posts]
    }


}
