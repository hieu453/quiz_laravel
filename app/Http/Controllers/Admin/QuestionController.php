<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function all()
    {
        $questions = Question::all();

        return view('admin.question.index', compact('questions'));
    }

    public function create()
    {
        $quizzes = Quiz::all();

        return view('admin.question.create', compact('quizzes'));
    }

    public function store(Request $request)
    {
        Question::create([
            'quiz_id' => $request->get('quiz_id'),
            'title' => $request->get('title'),
        ]);

        return redirect()->route('question.all');
    }

    public function importSpreadsheet()
    {
        $quizzes = Quiz::all();

        return view('admin.question.import', compact('quizzes'));
    }

    public function import(Request $request)
    {
        Excel::import(new QuestionImport($request->get('quiz_id')), request()->file('spreadsheet'));

        return redirect()->route('question.all');
    }
}
