<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuizImport;
use App\Jobs\ProcessExcel;
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

        return to_route('quiz.all');
    }

    public function importSpreadsheet()
    {
        return view('admin.quiz.import');
    }

    public function import(Request $request)
    {
        Excel::queueImport(new QuizImport, $request->file('spreadsheet'));

        return redirect()->back()->with('success', 'Import success!');
    }

    public function edit(int $id)
    {
        $quiz = Quiz::where('id', $id)->first();

        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, int $id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $quiz->update($request->all());

        return to_route('quiz.all');
    }

    public function destroy(int $id)
    {
        Quiz::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Delete success!');
    }

    public function deleteMultiple(Request $request)
    {
        Quiz::destroy($request->get('ids'));

        return response()->json(['message' => 'Delete quiz success!']);
    }
}
