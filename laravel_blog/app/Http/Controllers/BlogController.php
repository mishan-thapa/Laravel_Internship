<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
// Show all posts
public function index() {
    $posts = Post::orderBy('created_at', 'desc')->get();
    return view('blogs.index', ['posts' => $posts]);
  }
      
  // Create post
  public function create() {
    return view('blogs.create');
  }

// Store post
public function store(Request $request) {
    // validations
    $request->validate([
      'title' => 'required',
      'description' => 'required',
      'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $user = Auth::user();
    $username = $user->name;
    $file_name = time() . '.' . request()->image->getClientOriginalExtension();
    request()->image->move(public_path('images'), $file_name);

    $postData = [
      'title' => $request->title,
      'description' => $request->description,
      'image' => $file_name,
      'username' => $username,
    ];
    Post::create($postData);
    return redirect()->route('blogs.index')->with('success', 'Post created successfully.');
  }
}
