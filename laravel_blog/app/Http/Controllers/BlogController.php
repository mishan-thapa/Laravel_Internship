<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
//use App\Traits\ApiResponser;
use App\Http\Controllers\Controller;
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

    public function search(Request $request){
        $search = $request->search;
        $posts = $this->postRepository->search($search);
        return view('blog.index', compact('posts','search')); //['posts'=>$posts,'search'=>$search]
    }

    public function filterSearchView(){
        return view('blog.filterSearch');
    }

    public function filterSearch(Request $request){
        $title = '';
        $user = '';
        $query = Post::query();
        if($request->title){
            $title = $request->title;
            $query->where('title', 'LIKE','%' . $title . '%');
        }
        if($request->date){
            $query->where('created_at','>', $request->date);
        }

        if($request->user){
            $user = $request->user;
            $query->whereHas('user', function ($query) use($user){
                $query->where('name','Like', '%' . $user . '%');
            });
        }

        $posts = $query->orderBy('created_at','desc')->get();
        //dd($posts);
        return view('blog.filterSearch',['posts'=>$posts, 'title'=>$title, 'user'=>$user]);
    }

}
