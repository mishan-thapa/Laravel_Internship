<?php
namespace App\Repositories\Interfaces;

Interface TrashRepositoryInterface{
    public function allTrash();
    public function trashRestore($id);
    public function permanentDelete($id);
}
