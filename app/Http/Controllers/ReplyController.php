<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReplyRequest;
use App\Http\Requests\UpdateReplyRequest;
use App\Models\Reply;

class ReplyController extends Controller
{

    public function create()
    {
        $attributes = request()->validate([
            'body' => 'required|max:255',
            'user_id' => 'required|exists:users,id',
            'comment_id' => 'required|exists:comments,id'
        ]);

        Reply::create($attributes);
        return redirect()->back();
    }





}
