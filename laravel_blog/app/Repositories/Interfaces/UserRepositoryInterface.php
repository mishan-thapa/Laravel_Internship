<?php

namespace App\Repositories\Interfaces;

Interface UserRepositoryInterface{
    public function allUser();
    public function createUser($validated_data);
    public function deleteUser($id);
    public function submitForgetPasswordForm($validated_data);
    public function submitResetPasswordForm($validated_data,$token);
    public function generateTwoFactorCode($validated_data);
    public function getTwoFactorCode($email);
    public function resetTwoFactorCode($email);
    public function mailTwoFactorCode($validated_data,$twoFactorCode);
    public function verifyTwoFactorCode($twoFactorCode,$email);
}
