@extends('layouts.app')


@section('title') edit @endsection


@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <form method="POST" action="{{ route('post.update', $post->id) }}">
      @csrf
      @method('PUT')
  <div class="mb-3">
    <label class="form-label">Title</label>
    <input name="title" type="text" value="{{$post->title}}" class="form-control" value="{{ old('title') }}">
  </div>

  <div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control" rows="3" value="{{ old('description')}}">{{$post->description}} </textarea>
  </div>

  {{-- <div class="mb-3">
    <label class="form-label">Post Creator</label>
    <select name="post_creator" class="form-control">
            @foreach ($users as $user )
      <option @if ($user->id == $post->user_id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
        
      @endforeach
    </select>
  </div> --}}


    <div class="mb-3">
    <label class="form-label">Post Creator</label>
    <select name="post_creator" class="form-control">

      <option value="{{$users->id}}">{{$users->name}}</option>
        
    </select>
  </div>

  <button class="btn btn-primary">Update</button>
</form>

@endsection