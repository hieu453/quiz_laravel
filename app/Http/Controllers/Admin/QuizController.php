<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuizImport;
use App\Models\Category;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class QuizController extends Controller
{
    public function all(): View
    {
        return view('admin.quiz.index', [
            'quizzes'       => Quiz::all(),
            'categories'    => Category::all()
        ]);
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
        return view('admin.quiz.import', [
            'categories' => Category::all()
        ]);
    }

    public function import(Request $request)
    {
        try {
            Excel::import(new QuizImport($request->category_id), $request->file('spreadsheet'));
            return redirect()->back()->with('success', 'Import success!');

        } catch (\Exception $e) {
            return redirect()->back()->with('warning', 'Kiểm tra lại file excel đi!');
        }
    }

    public function edit(int $id)
    {
        return view('admin.quiz.edit', [
            'quiz' => Quiz::where('id', $id)->first(),
            'categories'    => Category::all()
        ]);
    }

    public function update(Request $request, int $id)
    {
        $quiz = Quiz::where('id', $id)->first();
        $quiz->update($request->all());

        return to_route('quiz.all');
    }

    // public function destroy(int $id)
    // {
    //     Quiz::where('id', $id)->delete();

    //     return redirect()->back()->with('success', 'Delete success!');
    // }

    public function deleteMultiple(Request $request)
    {
        Quiz::destroy($request->get('ids'));

        return response()->json(['message' => 'Delete quiz success!']);
    }
}
