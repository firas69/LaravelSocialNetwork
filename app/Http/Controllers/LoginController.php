<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function show(){
        return view('login');
    }
    public function store(){

        $attributes = request()->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes)){
            session()->regenerate();
            return redirect('/');
        }
        return back()
                ->withInput()
                ->withErrors(['message' => 'Failed']);

    }
    public function logout(){
        auth()->logout();
        return redirect('/');
    }
}
