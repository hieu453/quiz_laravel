<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\NewAnnouncement;
use Illuminate\Support\Facades\Notification;
use PhpParser\Node\Expr\New_;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        Comment::create($request->all());
        $comments = Comment::where('quiz_id', 25)->get();
        $commentUniqueByUserId = $comments->unique('user_id');
        $userIds = [];

        $messages = [
            'title'     => Auth::user()->name . " đã bình luận!!",
            'body'      => $request->message,
            'link'      => route('quiz.detail', ['id' => $request->quiz_id]),
            'linkText'  => ''
        ];

        foreach ($commentUniqueByUserId as $comment) {
            if ($comment->user_id !== Auth::user()->id) {
                $userIds[] = $comment->user_id;
            }
        }

        $users = User::find($userIds);
        // Auth::user()->notify(new NewAnnouncement($messages));

        Notification::send($users, new NewAnnouncement($messages, $userIds));

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
