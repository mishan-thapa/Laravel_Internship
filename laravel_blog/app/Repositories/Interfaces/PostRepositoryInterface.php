<?php

namespace App\Repositories\Interfaces;

Interface PostRepositoryInterface{
    public function allApprovedPost();
    public function allMyPost();
    public function allPost();
    public function allUnapprovedPost();
    public function softDelete($id);
    public function createFileName($image);
    public function storeNewPost($validated);
    public function findPost($id);
    public function updatePost($validated,$post);
    public function updateStatus($id);
}
