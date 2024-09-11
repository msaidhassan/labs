<!-- resources/views/posts/show.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $post['title'] }}</h1>
    <p><strong>Posted By:</strong> {{ $post->user->name ?? 'Unknown' }}</p>
    <p><strong>Content:</strong> {{ $post['content'] }}</p>
    <p><strong>Created At:</strong> {{ $post->human_readable_date }}</p>
    <img id="imagePreview" src="{{ asset('storage/' . $post['image']) }}" alt="Post Image" class="img-fluid mb-2">
    <h3>Comments:</h3>
@foreach ($post->comments as $comment)
    <div class="comment">
        <p>{{ $comment->body }}</p>
        <small>Commented by: {{ $comment->user->name }} on {{ $comment->created_at->format('Y-m-d') }}</small>
    </div>
@endforeach

<!-- Add comment form -->
<form action="{{ route('posts.addComment', $post) }}" method="POST">
    @csrf   
    <div class="form-group">
            <label for="commented_by">Comment by</label>
            <select name="commented_by" id="commented_by" class="form-control" required>
                <option value="">Select User</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
    <textarea name="body" rows="3" class="form-control" required></textarea>
    <button type="submit" class="btn btn-primary mt-2">Add Comment</button>
</form>
</div>
@endsection
