<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ApiResponser;
use App\Models\ApprovedPost;

class BlogController extends Controller
{
    use ApiResponser;
    // Show all posts
    public function index()
    {
        //$posts = Post::orderBy('created_at', 'desc')->get();//->paginate(1);//->get();
        //$response = $this->successResponse($posts);
        //return view('index',['responseData'=>$response]);
        $approved_posts = ApprovedPost::all();
        return view("blogs.index", ["approved_posts" => $approved_posts]);
    }

    // Create post
    public function create()
    {
        return view("blogs.create");
    }

    // Store post
    public function store(Request $request)
    {
        // validations
        $request->validate([
            "title" => "required",
            "description" => "required",
            "image" => "required|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);

        $user = Auth::user();
        $username = $user->name;
        $file_name =
            time() . "." . request()->image->getClientOriginalExtension();
        request()->image->move(public_path("images"), $file_name);

        $postData = [
            "title" => $request->title,
            "description" => $request->description,
            "image" => $file_name,
            "username" => $username,
        ];
        Post::create($postData);
        return redirect()
            ->route("blogs.index")
            ->with("success", "Post created successfully.");
    }

    public function show()
    {
        $user = Auth::user();
        $username = $user->name;
        $posts = Post::where("username", $username)->get();
        return view("blogs.show", ["posts" => $posts]);
    }
    public function edit(string $id)
    {
        $post = Post::find($id);
        //echo($post);
        return view("blogs.edit", ["post" => $post]);
    }

    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        $request->validate([
            "title" => "required",
            "description" => "required",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048",
        ]);
        $updateData = [
            "title" => $request->title,
            "description" => $request->description,
        ];
        if ($request->image) {
            $file_name =
                time() . "." . request()->image->getClientOriginalExtension();
            request()->image->move(public_path("images"), $file_name);
            $updateData["image"] = $file_name;
        }
        $post->update($updateData);
        return redirect(route("blogs.index"));
    }
}
