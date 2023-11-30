<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginValidateRequest;
use App\Repositories\Interfaces\PostRepositoryInterface;
use App\Repositories\Interfaces\TrashRepositoryInterface;

class AdminController extends Controller
{
    private $postRepository;
    private $trashRepository;

    public function __construct(PostRepositoryInterface $postRepository, TrashRepositoryInterface $trashRepository){
        $this->postRepository = $postRepository;
        $this->trashRepository = $trashRepository;
    }

    public function index(){
        //$adminUser = Auth::guard('admin')->user();
        //$adminName = $adminUser->name;
        //return view('admin.index',['adminName'=>$adminName]);
        $posts = $this->postRepository->allPost();
        return view('admin.index',compact('posts'));
    }
    public function login(){
        return view('admin.login');
    }
    public function authenticateLogin(LoginValidateRequest $request){
        //user authentication
        if (Auth::guard('admin')->attempt($request->only("email", "password"))) {
            return redirect()->route("admin.index");
        }
        return redirect(route("admin.login"))->withError(
            "Login details are not valid"
        );
    }
    public function delete(string $id){
        $this->trashRepository->permanentDelete($id);
        return redirect()->back();
    }
    public function logout(){
        \Session::flush();
        Auth::guard('admin')->logout();
        return redirect(route("blog.index"));
    }
}
