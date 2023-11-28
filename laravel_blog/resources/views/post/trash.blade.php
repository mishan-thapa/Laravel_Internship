@extends('layouts.app')
@section('content')
<div class="container">
  <div class="titlebar">
    <h1>Trash list</h1>
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
                        <div class="col-1">
                            <form method="post" action="{{ route('post.restore',['id' => $post->id]) }}">
                                @csrf
                                <input type="submit" value="Restore" />
                            </form>
                        </div>
                        <div class="col-1">
                            <form method="post" action="{{ route('post.trashDelete', ['id' => $post->id]) }}">
                                @csrf
                                @method('delete')
                                <input type="submit" value="Delete Permanently" />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        @endforeach
    @else
        <p>Trash Empty</p>
    @endif
</div>
@endsection
