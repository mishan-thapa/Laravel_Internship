<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserStoreRequest;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserController extends Controller
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return view("users.login");
    }

    public function create()
    {
        return view("users.register");
    }

    public function store(UserStoreRequest $request)
    {
        // Retrieve the validated input data...
        $validated_data = $request->validated();
        $this->userRepository->createUser($validated_data);
        return redirect()->route('users.login');
    }

    public function delete(string $id){
        $this->userRepository->deleteUser($id);
        $this->logout();
        return redirect(route('blog.index'));
    }

    public function edit(string $id){}

    public function update(Request $request, string $id){}

    public function login(UserLoginRequest $request)
    {
        //user authentication
        if (Auth::attempt($request->only("email", "password"))) {
            return redirect()->route("blog.index");
        }
        return redirect(route("users.index"))->withError(
            "Login details are not valid"
        );
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route("blog.index"));
    }


}
