@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Post</h1>
    <form action="{{ route('posts.update', $post['id']) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $post['title'] }}" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" style="height:80px" required>{{ $post['content'] }}</textarea>
        </div>
        <div class="form-group">
            <label for="posted_by">Posted By</label>
            <select name="posted_by" class="form-control" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $post->posted_by == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
            @endforeach
            </select>   
        </div>
        <div class="form-group">
            <label for="image">Current Image:</label>
            <img id="imagePreview" src="{{ asset('storage/' . $post['image']) }}" alt="Post Image" class="img-fluid mb-2">
            <input type="file" name="image" class="form-control" onchange="previewImage(event)">
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
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
<script>
    function previewImage(event) {
        const imagePreview = document.getElementById('imagePreview');
        imagePreview.src = URL.createObjectURL(event.target.files[0]);
        imagePreview.onload = () => URL.revokeObjectURL(imagePreview.src);  // Free memory
    }
</script>
@endsection