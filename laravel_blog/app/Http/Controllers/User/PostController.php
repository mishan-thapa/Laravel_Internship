<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository){
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->allMyPost();
        return view("post.index", compact('posts'));
    }

    // Create post
    public function create()
    {
        return view("post.create");
    }

    // Store post
    public function store(StorePostRequest $request)
    {
        $validated = $request->validated();
        $this->postRepository->storeNewPost($validated);
        return redirect()->route("post.index");
    }

    public function edit(string $id)
    {
        $post = $this->postRepository->findPost($id);
        return view("post.edit", compact('post'));
    }

    public function update(StorePostRequest $request, string $id)
    {
        $post = $this->postRepository->findPost($id);
        $validated = $request->validated();
        $this->postRepository->updatePost($validated, $post);
        return redirect(route("post.index"));
    }

    public function delete(string $id){
        $this->postRepository->softDelete($id);
        return redirect()->back();
    }

}
