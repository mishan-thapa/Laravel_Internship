<?php
namespace App\Repositories;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Repositories\Interfaces\TrashRepositoryInterface;

class TrashRepository implements TrashRepositoryInterface{
    public function allTrash(){
        $user_id = Auth::user()->id;
        $posts = Post::onlyTrashed()->where('user_id','=',$user_id)->get();
        return $posts;
    }

    public function trashRestore($id){
        $post = Post::where('id','=',$id)->restore();
    }

    public function permanentDelete($id){
        //$post = Post::where('id','=',$id)->forceDelete();
        $post = Post::onlyTrashed()->find($id);
        $image = $post['image'];
        $filePath = public_path('images/'.$image);
        //delete the file from public folder
        if(File::exists($filePath)){
            File::delete($filePath);
        }
        $post->forceDelete();
    }
}

