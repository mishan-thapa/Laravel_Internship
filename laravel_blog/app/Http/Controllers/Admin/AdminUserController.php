<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginValidateRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;

class AdminUserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }
    public function index(){
        $users = $this->userRepository->allUser();
        return view('admin.userList',compact('users'));
    }

    public function delete(string $id){
        $this->userRepository->deleteUser($id);
        return redirect()->back();
    }
}
