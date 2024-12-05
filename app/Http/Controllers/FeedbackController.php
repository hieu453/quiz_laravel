<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('admin.feedback.index');
    }

    public function sendFeedback(Request $request)
    {
        $messages = [
            'title'     => Auth::user()->name . " đã phản hồi!!",
            'body'      => $request->feedback,
            'link'      => route('feedback'),
        ];

        $users = User::where('is_admin', 1)->get();

        Notification::send($users, new Feedback($messages));

        return redirect()->back()->with('success', 'Đã phản hồi thành công!');
    }
}
