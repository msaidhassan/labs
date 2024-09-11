<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return PostResource::collection(Post::with('user')->get());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required|string|unique:posts,title|min:3',
            'content' => 'required|string',
        ]);

        $data['posted_by'] = auth()->id(); // Assign the logged-in user as the post creator
        $data['slug'] = \Str::slug($data['title']);

        $post = Post::create($data);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        //
        $post = Post::findOrFail($id);
       // dd($post);
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        //
        $post = Post::findOrFail($id);

        // Validate incoming request
        $data = $request->validate([
            'title' => 'required|string|unique:posts,title,' . $post->id . '|min:3',
            'content' => 'required|string',
        ]);

        $post->update($data);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        //
        $post = Post::findOrFail($id);

        // Soft delete the post
        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
