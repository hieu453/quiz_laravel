<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Option;
use App\Models\Comment;
use App\Models\Document;
use App\Models\Question;
use App\Models\UserPoint;
use App\Models\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index', [
            'quizzes' => Quiz::where('has_questions', 1)->cursorPaginate(2),
        ]);
    }

    public function quizDetail(int $id, Request $request)
    {
        $quiz = Quiz::find($id);
        $comments = Comment::whereNull('parent_id')->where('quiz_id', $id)->orderBy('created_at', 'DESC')->paginate(3);
        $commentsAndRepliesLength = Comment::where('quiz_id', $id)->count();
        $userPoints = DB::table('user_points')
                            ->join('users', 'users.id', '=', 'user_points.user_id')
                            ->select('user_points.points', 'users.name')
                            ->where('quiz_id', $id)
                            ->orderBy('points', 'desc')
                            ->distinct()
                            ->limit(5)
                            ->get();

        if ($request->ajax()) {
            $view = view('home.quiz.comments.comments', compact('comments'))->render();

            return response()->json(['html' => $view]);
        }

        return view('home.quiz.detail', [
            'quiz'                      =>  $quiz,
            'topFiveUsers'            => $userPoints,
            'comments'                  =>  $comments,
            'commentsAndRepliesLength'  => $commentsAndRepliesLength
        ]);
    }

    public function quizDocuments(int $id)
    {
        return view('home.quiz.documents', [
            'quiz_id'   => $id,
            'documents' => Document::where('quiz_id', $id)->get(),
        ]);
    }

    public function setQuestionsToSession(int $id)
    {
        if (session('questions')) {
            session()->forget('questions');
        }

        $questions = Question::where([
            ['quiz_id', '=', $id],
            ['has_options', '=', 1]
        ])->inRandomOrder()->limit(10)->get();

        session(['questions' => $questions]);

        return to_route('quiz.start', ['id' => $id]);
    }

    public function startQuizQuestions(int $id)
    {
        return view('home.question.show', [
            'questions' => session('questions'),
            'quiz'      => Quiz::find($id),
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

        $points = number_format((float)$points, 1, '.', '');

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

        UserPoint::create([
            'user_id' => Auth::user()->id,
            'quiz_id' => $request->quiz_id,
            'points'  => $points
        ]);

        return view('home.question.result', [
            'points'    => $points,
            'quiz_id'   => $request->quiz_id
        ]);
    }

    public function showCorrectAnswer($id)
    {
        $userAnswersIds = UserAnswer::where('quiz_id', $id)->orderBy('id', 'desc')->first()->answers;
        $questions = session('questions');
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
