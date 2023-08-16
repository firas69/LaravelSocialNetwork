<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function show(){
        return view('registration');
    }
    public function store(){


        $attributes = request()->validate([
            'name' => 'required|max:50',
            'user_name' => 'required|min:3|max:50|unique:users,user_name',
            'image' => 'required|image',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8'
        ]);
        if(request()->hasFile('image')){
            $destination_path = 'public/storage/images';
            $image_name = \request()->file('image')->getClientOriginalName();
            $path = \request()->file('image')->storeAs($destination_path, $image_name);
            $attributes['image']=$image_name;
        }
        $user = User::create($attributes);
        auth()->login($user);
        return redirect('/')->with(['message'=>'Your account has been created successfully!']);

    }
}
