@extends('layouts.app')
@section('content')
<div class="container">
  <div class="titlebar">
    <h1>Post list</h1>
  </div>

  <hr>
  <!-- Message if a post is posted successfully -->
  @if ($message = Session::get('success'))
  <div class="alert alert-success">
    <p>{{ $message }}</p>
  </div>
  @endif
     @if (count($posts) > 0)
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
  @else
    <p>No Posts found</p>
  @endif
</div>
@endsection
