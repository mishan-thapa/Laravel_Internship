<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostRepository implements PostRepositoryInterface{

    public function allApprovedPost(){
        $posts = Post::where('status','=','approved')->orderBy('created_at','desc')->paginate(5);
        return $posts;
    }

    public function allMyPost(){
        $user_id = Auth::user()->id;
        $posts = Post::where('user_id','=',$user_id)->orderBy('created_at','desc')->paginate(5);
        return $posts;
    }

    public function allPost(){
        $posts = Post::orderBy('created_at','desc')->paginate(5);//->get();
        return $posts;
    }

    public function allUnapprovedPost(){
        $posts = Post::where('status','=','unapproved')->get();
        return $posts;
    }

    public function softDelete($id){
        $post = Post::where('id','=',$id)->delete();
    }

    public function createFileName($image){
        $file_name = time() . "." . $image->getClientOriginalExtension();
        return $file_name;
    }

    public function storeNewPost($validated){
        $user = Auth::user();
        $user_id = $user->id;
        $file_name =$this->createFileName($validated['image']);
        $validated['image']->move(public_path("images"), $file_name);
        $postData = [
            "title" => $validated['title'],
            "description" => $validated['description'],
            "image" => $file_name,
            "user_id" => $user->id,
        ];
        Post::create($postData);
    }

    public function findPost($id){
        $post = Post::find($id);
        return $post;
    }

    public function updatePost($validated,$post){
        $updateData = [
            "title" => $validated['title'],
            "description" => $validated['description'],
        ];
        if(isset($validated['image'])){
            $file_name =$this->createFileName($validated['image']);
            $validated['image']->move(public_path("images"), $file_name);
            $updateData["image"] = $file_name;
        }
        $post->update($updateData);
    }

    public function updateStatus($id){
        $post = Post::where('id','=',$id)
            ->update(['status'=>'approved']);
    }

    public function search($search){
        $posts = Post::where('title','LIKE', '%' . $search . '%')
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('name', 'LIKE', '%'. $search . '%');
            })
            ->orderBy('created_at','desc')
            ->paginate(5);
        return $posts;
    }

}
