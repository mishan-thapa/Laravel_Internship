<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\TrashRepositoryInterface;

class UnapprovedPostController extends Controller
{
    private $postRepository;
    private $trashRepository;

    public function __construct(postRepositoryInterface $postRepository, trashRepositoryInterface $trashRepository){
        $this->postRepository = $postRepository;
        $this->trashRepository = $trashRepository;
    }

    public function index(){
        $posts = $this->postRepository->allUnapprovedPost();
        return view("admin.unapprovedPost", compact('posts'));
    }
    public function update(string $id){
        $this->postRepository->updateStatus($id);
        return redirect()->back();
    }
    public function delete(string $id){
        $this->trashRepository->permanentDelete($id);
        return redirect()->back();
    }
}
