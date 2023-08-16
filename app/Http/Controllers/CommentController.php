<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function comment(){
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id'

        ]);
    //        dd($attributes);
        Comment::create($attributes);
        return redirect()->back();
    }
}
