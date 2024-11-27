<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Option;
use App\Models\Comment;
use App\Events\PlayQuiz;
use App\Models\Question;
use App\Models\UserPoint;
use App\Models\UserAnswer;
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

        return view('home.index', [
            'quizzes' => $quizzes
        ]);
    }

    public function quizDetail(int $id, Request $request)
    {
        $quiz = Quiz::find($id);
        $comments = Comment::whereNull('parent_id')->where('quiz_id', $id)->orderBy('created_at', 'DESC')->paginate(3);
        $commentsAndRepliesLength = Comment::where('quiz_id', $id)->orderBy('created_at', 'DESC')->count();

        if ($request->ajax()) {
            $view = view('home.quiz.comments.comments', compact('comments'))->render();

            return response()->json(['html' => $view]);
        }

        return view('home.quiz.detail', [
            'quiz'      =>  $quiz,
            'comments'  =>  $comments,
            'commentsAndRepliesLength' => $commentsAndRepliesLength
        ]);
    }

    public function startQuizQuestions(int $id)
    {
        $questions = Question::where([
            ['quiz_id', '=', $id],
            ['has_options', '=', 1]
        ])->get();

        return view('home.question.show', [
            'questions' => $questions,
            'quiz_id'      => $id,
        ]);
    }

    public function checkResult(Request $request)
    {
        $pointPerQuestion = (float)10 / $request->number_of_questions;
        $points = 0;

        $answers = Option::find($request->answers);

        if ($answers) {
            foreach ($answers as $answer) {
                if ($answer->is_correct == 1) {
                    $points += $pointPerQuestion;
                }
            }
        }

        $points = number_format((float)$points, 2, '.', '');

        $answered = UserAnswer::where('quiz_id', $request->quiz_id)->first();
        if ($answered) {
            $answered->update([
                'quiz_id' => $request->quiz_id,
                'answers' => $request->answers
            ]);
        } else {
            UserAnswer::create([
                'user_id' => Auth::user()->id,
                'quiz_id' => $request->quiz_id,
                'answers' => $request->answers
            ]);
        }

        // UserPoint::create([
        //     'user_id' => Auth::user()->id,
        //     'quiz_id' => $request->quiz_id,
        //     'points'  => $points
        // ]);

        return view('home.question.result', [
            'points'    => $points,
            'quiz_id'   => $request->quiz_id
        ]);
    }

    public function showCorrectAnswer($id)
    {
        $userAnswersIds = UserAnswer::where('quiz_id', $id)->orderBy('id', 'desc')->first()->answers;
        $questions = Quiz::find($id)->questions;
        // dd($questions);

        $userAnswers = Option::find($userAnswersIds);

        $userCorrectAnswers = 0;

        if ($userAnswers) {
            foreach($userAnswers as $answer) {
                if ($answer->is_correct) {
                    $userCorrectAnswers++;
                }
            }
        }
        // dd($userAnswers);
        return view('home.question.correct-answers', [
            'questions'             => $questions,
            'userAnswers'           => $userAnswers,
            'userCorrectAnswers'    => $userCorrectAnswers
        ]);
    }

}
