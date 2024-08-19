<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create($request->all());

        return redirect()->back();
    }

    public function update(Request $request, int $id)
    {
        $comment = Comment::where('id', $id)->first();
        $comment->update($request->all());

        return redirect()->back();
    }
}
