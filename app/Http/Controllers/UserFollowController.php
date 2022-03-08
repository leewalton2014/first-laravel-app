<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index(User $user)
    {
        $users = $user->followers()->paginate(8);

        return view('people.followers', [
            'users' => $users,
            'user' => $user
        ]);
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
