<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $numberOfQuizzes = Quiz::all()->count();
        $numberOfQuestions = Question::all()->count();
        $numberOfCategories = Category::all()->count();
        $numberOfUsers = User::all()->count();

        return view('admin.dashboard', [
            'numberOfQuizzes'       => $numberOfQuizzes,
            'numberOfQuestions'     => $numberOfQuestions,
            'numberOfCategories'    => $numberOfCategories,
            'numberOfUsers'         => $numberOfUsers
        ]);
    }
}
