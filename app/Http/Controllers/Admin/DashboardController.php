<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $numberOfQuizzes = Quiz::all()->count();
        $numberOfQuestions = Question::all()->count();

        return view('admin.dashboard', compact('numberOfQuizzes', 'numberOfQuestions'));
    }
}
