<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    use ApiResponser;
    // Show all posts
    public function index()
    {
        $posts = Post::where('status', '=', 'approved')
                    ->orderBy('created_at', 'desc')
                    ->paginate(2);//->get();
        //$response = $this->successResponse($posts);
        //return view('index',['responseData'=>$response]);
        return view("post.index", ["posts" => $posts]);
    }

    // Create post
    public function create()
    {
        return view("post.create");
    }

    // Store post
    public function store(StorePostRequest $request) //Request $request
    {
        $user = Auth::user();
        $user_id = $user->id;
        $file_name =
            time() . "." . request()->image->getClientOriginalExtension();
        request()->image->move(public_path("images"), $file_name);

        $postData = [
            "title" => $request->title,
            "description" => $request->description,
            "image" => $file_name,
            "user_id" => $user->id,
        ];
        Post::create($postData);
        return redirect()
            ->route("post.index")
            ->with("success", "Post created successfully.");
    }

    public function show()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $posts = Post::where("user_id", $user_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
        return view("post.show", ["posts" => $posts]);
    }
    public function edit(string $id)
    {
        $post = Post::find($id);
        return view("post.edit", ["post" => $post]);
    }

    public function update(StorePostRequest $request, string $id)
    {
        $post = Post::find($id);
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
        return redirect(route("post.index"));
    }

    public function delete(string $id){
        $post = Post::where('id','=',$id);//->get();
        $post->delete();
        return redirect()->back();
    }

    public function trash(){
        $user_id = Auth::user()->id;
        $posts = Post::onlyTrashed()->where('user_id','=',$user_id)->get();
        return view('post.trash',['posts'=>$posts]);
    }

    public function restore(string $id){
        $post = Post::where('id','=',$id)->restore();
        return redirect()->back();
    }
    public function trashDelete(string $id){
        $post = Post::where('id','=',$id)->forceDelete();
        return redirect()->back();
    }

}
