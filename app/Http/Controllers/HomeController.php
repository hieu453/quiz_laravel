<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Events\PlayQuiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Events\NotificationEvent;
use App\Notifications\ClickButton;
use App\Notifications\exBroadcast;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $quizzes = Quiz::where('has_questions', 1)->cursorPaginate(2);

        return view('home.index', compact('quizzes'));
    }

    public function quizDetail(int $id)
    {
        $quiz = Quiz::find($id);
        return view('home.quiz.detail', compact('quiz'));
    }

    public function startQuizQuestions(int $id)
    {
        $user = User::where('is_admin', 1)->first();

        $currentUser = Auth::user()->name;
        $questions = Question::where('quiz_id', $id)->inRandomOrder()->get();

        $questions = Question::where([
            ['quiz_id', '=', $id],
            ['has_options', '=', 1]
        ])->inRandomOrder()->get();

        $notification = new \MBarlow\Megaphone\Types\General(
            'Expected Downtime!', // Notification Title
            "User {$currentUser} is playing quiz" // Notification text
        );

        // NotificationEvent::dispatch();
        $user->notify($notification);

        return view('home.question.show', compact('questions'));
    }

    public function checkResult(Request $request)
    {
        $pointPerQuestion = (float)10 / $request->number_of_questions;
        $points = 0;

        if ($request->answers) {
            foreach ($request->answers as $answer) {
                if ((int) $answer == 1) {
                    $points += $pointPerQuestion;
                }
            }
        }

        $points = number_format((float)$points, 2, '.', '');

        return view('home.question.result', compact('points'));
    }

//    public function result()
//    {
//        return view('home.question.result');
//    }

}
