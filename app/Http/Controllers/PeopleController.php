<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->with(['likes', 'comments'])->paginate(8);
        // orderBy() can be replaced with latest() method

        return view('people.search', [
            'users' => $users,
            'term' => ''
        ]);
    }

    public function show(Request $request)
    {
        $this->validate($request,[
            'search' => 'required'
        ]);

        $search = $request->input('search');

        $users = User::where('name', 'like', '%'.$search.'%')->orWhere('username', 'like', '%'.$search.'%')->orderBy('created_at', 'desc')->with(['likes', 'comments'])->paginate(8);

        return view('people.search', [
            'users' => $users,
            'term' => $search
        ]);
    }
}
