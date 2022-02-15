<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes', 'comments'])->paginate(8);
        // orderBy() can be replaced with latest() method

        return view('posts.index', [
            'posts' => $posts
        ]);
    }

    public function show(Post $post)
    {
        $comments = $post->comments()->with(['user'])->paginate(8);

        return view('posts.show',[
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'body' => 'required'
        ]);

        // Post::create([
        //     'user_id' => auth()->id(),
        //     'body' => $request->body
        // ]);
        
        //can create post through user model by adding post relationship

        $request->user()->posts()->create($request->only('body'));

        return back();
    }

    public function destroy(Post $post)
    {
        // if (!$post->ownedBy(auth()->user())) {
        //     return back();
        // }

        //use policy to check current user can delete
        $this->authorize('destroy', $post);
        
        $post->delete();

        return back();
    }
}
