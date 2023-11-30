<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LaravelBlog</title>
  <!-- Styles-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<!-- Navbar-->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('blog.index')}}">Laravel Blog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">

          @auth
          <li class="nav-item">
            <a class="nav-link" href="{{ route('post.create') }}">Add Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('post.index') }}">My Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('trash.index') }}">Trash</a>
          </li>
          <li>
            <form method="post" action="{{ route('users.logout') }}">
              @csrf
              <input type="submit" value="logout" />
          </form>
          </li>
          <li>
            <form method="post" action="{{ route('users.delete',['id'=>auth()->id()]) }}">
              @csrf
              @method('delete')
              <input type="submit" value="deleteAccount" />
          </form>
          </li>

          @else
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('users.index')}}">Log In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{route('users.create')}}">Register</a>
          </li>
          @endauth
        </ul>
      </div>
    </div>
  </nav>


<!-- Body -->
<div class="container">
    <h1>Add Post</h1>
    <section class="mt-3">
      <form method="post" action="{{ route('post.store') }}" enctype="multipart/form-data">
        @csrf
        <!-- Error message when data is not inputted -->
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif
        <div class="card p-3">
          <label for="floatingInput">Title</label>
          <input class="form-control" type="text" name="title">
          <label for="floatingTextArea">Description</label>
          <textarea class="form-control" name="description" id="floatingTextarea" cols="30" rows="10"></textarea>
          <label for="formFile" class="form-label">Add Image</label>
          <img src="" alt="" class="img-blog">
          <input class="form-control" type="file" name="image">
        </div>
        <button class="btn btn-secondary m-3">Save</button>
      </form>
    </section>

  </div>

<!-- Footer -->
<footer class="footer mt-auto py-3 bg-dark">
  <div class="container d-lg-flex justify-content-between">
    <span class="text-light">Laravel-Blog © 2023</span>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</html>

