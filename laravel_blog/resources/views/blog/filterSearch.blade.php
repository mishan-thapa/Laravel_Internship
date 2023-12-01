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
    <h1>Filter Search</h1>
        <form method="post" action="{{ route('blog.filterSearch') }}">
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
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="{{ isset($title) ? $title : '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="user">User:</label>
                            <input type="text" class="form-control" id="user" name="user" placeholder="Enter user" value="{{ isset($user) ? $user : '' }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="date">Date:</label>
                            <input type="date" class="form-control" id="date" name="date">
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
    </div>

</div>

<div class="container">


    <hr>
    <!-- Message if a post is posted successfully -->
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
      <p>{{ $message }}</p>
    </div>
    @endif
    @if (isset($posts) ? count($posts) : 0 > 0)
        <div class="titlebar">
            <h1>Post list</h1>
        </div>
        @foreach ($posts as $post)
            <div class="row">
            <div class="col-12">
                <div class="row">
                <div class="col-3">
                    <img class="img-fluid" style="max-width:90%;" src="{{ asset('images/'.$post->image)}}" alt="">
                </div>
                <div class="col-6">
                    <h4>{{$post->title}}</h4>
                    <p>{{$post->description}}</p>

                    <!-- Check if the user relationship exists -->
                    @if($post->user)
                    <p>Posted by: {{ $post->user->name }}</p>
                    @else
                    <p>Posted by: Unknown user</p>
                    @endif
                </div>
                </div>
            </div>
            </div>
            <br>
        @endforeach
    @endif
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

