<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Query Builder CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- <pre>
                        @php
                            print_r($errors->all());
                        @endphp
                    </pre> --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" >
                        <span class="text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <div class="mb-3">
                        <label for="faculty" class="form-label">faculty</label>
                        <input type="text" class="form-control" id="faculty" name="faculty" >
                    </div>
                    <div class="mb-3">
                        <label for="grade" class="form-label">grade</label>
                        <input type="number" class="form-control" id="grade" name="grade" >
                        <span class="text-danger">
                            @error('grade')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary">submit</button>
                </form>
                @if (session()->has('status'))
                    <div class="alert alert-success">
                        {{session('status')}}
                    </div>
                @endif
            </div>
            <div class="col-sm-8">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Faculty</th>
                        <th scope="col">Grade</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <th>{{ $student->id}}</th>
                                <td>{{ $student->name}}</td>
                                <td>{{ $student->faculty}}</td>
                                <td>{{ $student->grade}}</td>
                                <td>
                                    <a href="{{url('/edit_form',$student->id)}}" class="btn btn-info btn-sm">Edit</a>
                                    <a href="{{ url('/destroy',$student->id) }}" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
