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
      <a class="navbar-brand" href="{{route('admin.index')}}">Admin Home</a>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.unapproved.index') }}">unapprovedPosts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.user.index') }}">UserList</a>
          </li>
          <li>
            <form method="post" action="{{ route('admin.logout') }}">
                @csrf
                <input type="submit" value="logout" />
            </form>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<!-- Body -->
<div class="container">
    <div class="titlebar">
      <h1>User list</h1>
    </div>
      @if (count($users) > 0)
      <table class="table">
        <thead>
          <tr>
            <th scope="col">name</th>
            <th scope="col">email</th>
            <th scope="col">action</th>
          </tr>
        </thead>
        @foreach ($users as $user)
        <tbody>
            <tr>
              <td>{{$user->name}}</td>
              <td>{{$user->email}}</td>
              <td>
                <form method="post" action="{{ route('admin.user.delete', ['id' => $user->id]) }}">
                    @csrf
                    @method('delete')
                    <input type="submit" value="Delete" />
                </form>
              </td>
            </tr>
          </tbody>
        @endforeach

      </table>
      @else
          <p>No Users found</p>
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
