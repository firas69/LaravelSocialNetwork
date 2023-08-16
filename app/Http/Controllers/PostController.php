<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function search(){
        return view('home' ,[
                'posts' => Post::latest()->filterSearch(\request(['search', 'category', 'author']))->paginate(6)->withQueryString(),
                'categories' => Category::all(),
                'currentCategory' => \request('category') != '' ? Category::firstWhere('slug', request('category')) : null
        ]);
    }
    public function show(Post $post){
        return view('post', [
            'post' => $post
        ]);
    }
    public function myPosts(){
        $posts = Post::where('user_id', auth()->user()->id)->get();
        return view('myPosts', [
            'posts' => $posts
        ]);
    }
    public function post(){

        $attributes = request()->all(); // Get all the input attributes

        $attributes['excerpt'] = substr($attributes['body'], 0, 40);

        $attributes['slug'] = strtolower($attributes['title']);

        $validatedAttributes = Validator::make($attributes, [
            'title' => 'required|max:50',
            'excerpt' => 'required|max:50',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
            'body' => 'required|max:255',
            'image' => 'image',
            'slug' => 'required|max:50',
        ])->validate();

        if(request()->hasFile('image')){
            $destination_path = '/public/images/';
            $image_name = \request()->file('image')->getClientOriginalName();
            $path = \request()->file('image')->storeAs($destination_path, $image_name);
            $validatedAttributes['image']=$image_name;
        }else{
            $validatedAttributes['image']='Default';
        }
        $post = Post::create($validatedAttributes);
        return redirect('/')->with(['message'=>'Your post has been added successfully!']);
    }

}
