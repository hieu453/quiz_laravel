<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();

        return view('home.index', compact('quizzes'));
    }

    public function showQuizQuestions(int $id)
    {
        $questions = Question::where('quiz_id', $id)->get();

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

        return view('home.question.result', compact('points'));
    }
}
