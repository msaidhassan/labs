<?php
namespace App\Http\Controllers;

use App\Models\Post;
//use APP\public\Storage;
use App\Models\User;

use Illuminate\Http\Request;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }
    public function index()
    {
        // dd(get_class(new Post()));

        //
        $posts = Post::with('user')->paginate(3); // Adjust pagination as needed
        return view('posts.index', compact('posts'));
    }

    public function destroy($id)
    {
        // dump($);

        $post = Post::find($id);
        $this->authorize('delete', $post);

        $post->delete();
        //dd($post);

         return redirect()->route('posts.index')->with('success', 'Post deleted successfully');

    }

    public function store(StorePostRequest $request)
    {
        // $validated = $request->validate([
        //     'title' => 'required|min:3|unique:posts,title',
        //     'content' => 'required|min:10',
        //     'posted_by' => 'required|exists:users,id',
        // ]);

        // // $data = $request->only(['title', 'content','posted_by']);
       
        $data = $request->validated();
        $data['posted_by'] = auth()->id();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        $data['slug'] = \Str::slug($data['title']);

        Post::create( $data);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function create()
{
    
    $users = auth()->id(); // Get all users for dropdown

    return view('posts.create',compact('users'));
}
public function show($id)
{
// dd($id);
    $post = Post::find($id); // Assuming you have a way to find the post by its ID
    $users = User::all(); // Get all users for dropdown

    return view('posts.show', compact('post','users'));
}
public function edit($id)
    {
        $post = Post::find($id);
        $user = Auth::user();
        if (Gate::allows('modify-post', $post)) {
            $users = User::all();
            return view('posts.edit', compact('post', 'users'));
        } else {
            abort(403); // Forbidden
        }
    }
    public function update(UpdatePostRequest $request, $id)
    {
        // dd($request->all());
        $post = Post::find($id);
       // $data = $request->all();
        // $validated = $request->validate([
        //     'title' => 'required|min:3|unique:posts,title,' . $post->id,
        //     'content' => 'required|min:10',
        //     'posted_by' => 'required|exists:users,id',
        // ]);
    //     if ($request->hasFile('image')) {
    //         // dd($post);

    //   //      Storage::delete('public/' . $post['image']);

    //   $validated['image'] = $request->file('image')->store('images', 'public');
    // } 
      //  $post = new Post(); // Create an instance of your Post class
      $data = $request->validated();
      if ($request->hasFile('image')) {
        $data['image'] = $request->file('image')->store('images', 'public');
    }
      $data['slug'] = \Str::slug($data['title']);

        $post->update($data);
    
        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }
   
    public function trashed()
    {
        $posts = Post::onlyTrashed()->with('user')->get(); // Eager load user relationships
        $users = User::all();
        return view('posts.trashed', compact('posts', 'users'));
    }
    public function restore($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->route('posts.index')->with('success', 'Post restored successfully');
    }
    public function addComment(Request $request, Post $post)
    {
        // dd($post)
        // $request->validate([
        //     'body' => 'required|min:3',
        // ]);
    
        $post->comments()->create([
            'body' => $request->input('body'),
            'user_id' => $request->commented_by,
        ]);
    
        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }

}

