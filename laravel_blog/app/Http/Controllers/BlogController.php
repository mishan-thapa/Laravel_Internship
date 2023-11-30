<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Traits\ApiResponser;
use App\Repositories\Interfaces\PostRepositoryInterface;

class BlogController extends Controller
{
    //use ApiResponser;
    private $postRepository;

    public function __construct(postRepositoryInterface $postRepository){
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->allApprovedPost();
        return view("blog.index", compact('posts')); //["posts" => $posts]
        //$response = $this->successResponse($posts);
        //return view('index',['responseData'=>$response]);
    }


}
