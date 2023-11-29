<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface{
    public function index(){
        return view('users.login');
    }
}

