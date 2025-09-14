@extends('layouts.app')
@section('title') Index @endsection

@section('content')

<div class="mt-5">
  <div class="text-center">
    <a href="{{route('post.create')}}" class="btn btn-success">Create Post</a>
  </div>
</div>



<div class="container mt-5">
  <div class="card shadow">
    <div class="card-body">

      <table class="table">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col">Title</th>
            <th scope="col">Posted by</th>
            <th scope="col">Created at</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($posts as $post)
            
          <tr>
            <th scope="row">{{$post['id']}}</th>
            <td>{{$post['title']}}</td>
            <td>{{$post->user ? $post->user->name : 'not found'}}</td>
            <td>{{$post['created_at']}}</td>
            <td>
              <a href="{{route('post.show',$post['id'])}}" class="btn btn-info btn-sm">View</a>
              <a href="{{route('post.edit',$post['id'])}}" class="btn btn-primary btn-sm">Edit</a>
              <form method="POST" action="{{ route('post.destroy', $post['id']) }}" style="display:inline;">
                @csrf
                @method('DELETE')
                <button 
                type="submit" class="btn btn-danger btn-sm"
                onclick="return confirm('Are you sure you want to delete this post?');"
                >Delete
              </button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

@endsection