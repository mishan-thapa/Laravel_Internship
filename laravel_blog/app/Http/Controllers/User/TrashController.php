<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\TrashRepositoryInterface;

class TrashController extends Controller
{
    private $trashRepository;

    public function __construct(TrashRepositoryInterface $trashRepository){
        $this->trashRepository = $trashRepository;
    }

    public function index(){
        $posts =$this->trashRepository->allTrash();
        return view('trash.index',compact('posts')); //['posts'=>$posts]
    }

    public function update(string $id){
        $this->trashRepository->trashRestore($id);
        return redirect()->back();
    }
    public function delete(string $id){
        $this->trashRepository->permanentDelete($id);
        return redirect()->back();
    }
}
