<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface{

    public function allUser(){
        return User::all();
    }

    public function createUser($data){
        User::create($data);
    }

    public function deleteUser($id){
        User::where('id','=',$id)->delete();
    }
}
