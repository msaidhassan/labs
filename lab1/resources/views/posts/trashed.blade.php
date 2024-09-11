@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Trashed Posts</h1>
    <!-- <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a> -->
    <a href="{{ route('posts.index') }}" class="btn btn-secondary">Back to Posts</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Posted By</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user->name ?? 'Unknown' }}</td> <!-- Show user's name -->
                    <td>{{ $post->human_readable_date }}</td>

                    <td>
                        <form action="{{ route('posts.restore', $post->id) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-success">Restore</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
