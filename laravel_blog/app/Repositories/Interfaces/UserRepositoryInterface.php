<?php

namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
    public function allUser();
    public function createUser($validated_data);
    public function deleteUser($id);
    public function submitForgetPasswordForm($validated_data);
    public function submitResetPasswordForm($validated_data,$token);
}
