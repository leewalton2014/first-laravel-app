<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function store(Request $request)
    {
        //validation
        $this->validate($request, [
            'email' => 'required|email|max:225',
            'password' => 'required',
        ]);

        //sign in the user
        if (!auth()->attempt($request->only('email','password'))){
            return back()->with('status', 'Invalid login details');
        }

        //redirect
        return redirect()->route('dashboard');
    }
}
