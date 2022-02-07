<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class PostCommentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(Post $post, Request $request)
    {
        $this->validate($request,[
            'comment_body' => 'required'
        ]);

        $post->comments()->create([
            'user_id' => $request->user()->id,
            'comment_body' => $request->comment_body,
        ]);

        return back();
    }

    public function destroy(Comment $comment, Request $request)
    {
        $this->authorize('destroy', $comment);

        $request->user()->comments()->where('id', $comment->id)->delete();

        return back();
    }
}
