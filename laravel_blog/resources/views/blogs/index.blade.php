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
         @if (count($approved_posts) > 0)
    @foreach ($approved_posts as $approved_post)
      <div class="row">
        <div class="col-12">
          <div class="row">
            <div class="col-3">
              <img class="img-fluid" style="max-width:90%;" src="{{ asset('images/'.$approved_post->post->image)}}" alt="">
            </div>
            <div class="col-6">
              <h4>{{$approved_post->post->title}}</h4>
              <p>{{$approved_post->post->description}}</p>
              <h6>-{{$approved_post->post->username}}</h6>
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
