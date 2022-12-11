@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{url('create')}}" ><button type="button" class="btn btn-primary">Add Post</button></a>
                </div>
                <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>
                        <th scope="col">Image</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>
                      </tr>
                    </thead>
                    <tbody>
                   @php $key = 1 @endphp
                    @foreach ($posts as $post)
                    <tr>
                        <th scope="row">{{$key++}}</th>
                        <td>{{$post->title}}</td>
                        <td>{{$post->body}}</td>
                        <td><img src="{{ asset('public/Image/'.$post->image)}}" width="80px" height="80px" alt="tag"></td>
                        <td><a href="{{url('editpost/'.$post->id)}}" ><button type="button" class="btn btn-success">Edit </button></a></td>
                        <td><a href="{{url('deletepost/'.$post->id)}}" ><button type="button" class="btn btn-danger">Delete </button></a></td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>

            </div>

        </div>
    </div>
</div>

@endsection
