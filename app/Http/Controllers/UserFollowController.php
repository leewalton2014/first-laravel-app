<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function store(User $user)
    {
        if ($user->followedBy(auth()->user())){
            return back();
        }

        $user->follows()->create([
            'follower_id' => auth()->user()->id,
        ]);

        return back();
    }

    public function destroy(User $user)
    {
        $user->follows()->where('follower_id', auth()->user()->id)->delete();

        return back();
    }
}
