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

    // public function showMoreComment(Request $request)
    // {
    //     $comments = Comment::whereNull('parent_id')->orderBy('created_at', 'DESC')->paginate(2);

    //     $quiz_id = $quiz->id;

    //     if ($request->ajax()) {
    //         $view = view('home.quiz.comments.comments', compact('comments', 'quiz_id'))->render();

    //         return response()->json(['html' => $view]);
    //     }
    // }
}
