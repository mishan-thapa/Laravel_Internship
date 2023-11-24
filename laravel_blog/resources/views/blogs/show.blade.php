@extends('layouts.app')
@section('content')
<div class="container">
  <div class="titlebar">
    <h1>My Post list</h1>
  </div>

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
                        </div>
                        <div class="col-2">
                            <h4>status: {{$post->status}}</h4>
                        </div>
                        <div class="col-1">
                            <form method="get" action="{{ route('blogs.edit',['id' => $post->id]) }}">
                                @csrf
                                <input type="submit" value="Edit Post" />
                            </form>

                            <form method="post" action="{{ route('blogs.delete', ['id' => $post->id]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete" />
                            </form>
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
