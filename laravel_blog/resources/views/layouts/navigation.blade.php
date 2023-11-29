
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
