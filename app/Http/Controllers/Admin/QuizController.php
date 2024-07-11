<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuizImport;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class QuizController extends Controller
{
    public function all(): View
    {
        $quizzes = Quiz::all();

        return view('admin.quiz.index', compact('quizzes'));
    }

    public function create(): View
    {
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        Quiz::create($request->all());

        return redirect()->route('quiz.all');
    }

    public function importSpreadsheet()
    {
        return view('admin.quiz.import');
    }

    public function import(Request $request)
    {
        Excel::import(new QuizImport, $request->file('spreadsheet'));

        return redirect()->route('quiz.all');
    }
}
