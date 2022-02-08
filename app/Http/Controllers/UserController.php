<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function update(Request $request)
    {
        //validation
        $this->validate($request, [
            'name' => 'required|max:225',
            'username' => 'required|max:225|unique:users,username,'.auth()->user()->id,
            'email' => 'required|email|max:225|unique:users,email,'.auth()->user()->id,
        ]);
        
        //store user information
        $request->user()->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email]);

        //redirect
        return back();
    }
}
