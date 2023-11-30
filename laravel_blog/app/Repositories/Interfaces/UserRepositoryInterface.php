<?php

namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
    public function allUser();
    public function createUser($data);
    public function deleteUser($id);
}
