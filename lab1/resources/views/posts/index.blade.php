@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Posts</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">Create Post</a>
    <a href="{{ route('posts.trashed') }}" class="btn btn-warning">Restore Post</a>

    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>

                <th>Posted By</th>
                <th>Image</th> <!-- New Image Column -->

                <th>Created At</th>

                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post->slug }}</td>
    
                    <!-- <td>{{ $post['posted_by'] }}</td> -->
                    <td>{{ $post->user->name ?? 'Unknown' }}</td> <!-- Show user's name -->

                    <td>
                            <img src="{{ asset('storage/' . $post['image']) }}" alt="{{ $post['title'] }}" width="100">
                    </td>
                    <!-- <td>{{ \Carbon\Carbon::parse($post['created_at'])->format('Y-m-d') }}</td> -->
                    <td>  {{ $post->human_readable_date }}</td>

                    <td>
                        <a href="{{ route('posts.show', $post['id']) }}" class="btn btn-info">View</a>
                        
                        <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-primary">Edit</a>
                        <form id="delete-form-{{ $post->id }}"  action="{{ route('posts.destroy', $post['id']) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger" onclick="confirmDelete('delete-form-{{ $post->id }}')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">

    {{ $posts->links('pagination::bootstrap-5') }}
    </div>
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
<script>
function confirmDelete(formId) {
    if (confirm("Are you sure you want to delete this post?")) {
        document.getElementById(formId).submit();
    }
}
</script>
