<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeFeedController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index(Request $request)
    {
        //$posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes', 'comments'])->paginate(8);
        // orderBy() can be replaced with latest() method
        $posts = $request->user()->follows()->users()->posts()->paginate(8);



        return view('posts.index', [
            'posts' => $posts
        ]);
    }
}
