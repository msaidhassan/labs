<!-- resources/views/posts/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" style="height:80px" required></textarea>
        </div>
        <div class="form-group">
            <label for="posted_by">Posted By</label>
            {{-- <select name="posted_by" class="form-control" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
            </select>--}}
            <input type="hidden" name="posted_by" value="{{ auth()->id() }}"> <!-- Hidden input for the user ID -->
    <p class="form-control">{{ auth()->user()->name }}</p> <!-- Display the user's name -->

        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@endsection