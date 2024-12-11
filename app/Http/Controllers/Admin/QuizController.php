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
        $validatedData = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'required|max:255'
        ]);
        $validatedData['category_id'] = $request->category_id;
        $validatedData['has_question'] = 0;

        Quiz::create($validatedData);

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
        $request->validate([
            'spreadsheet' => 'required'
        ]);

        try {
            Excel::import(new QuizImport($request->category_id), $request->file('spreadsheet'));

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $message = '';
            foreach ($failures as $failure) {
                $message = "Tên môn học '{$failure->values()['title']}' đã tồn tại! Kiểm tra lại dòng số {$failure->row()}";
                break;
            }
            return redirect()->back()->with('danger', $message);
        }
        return redirect()->back()->with('success', 'Nhập thành công!');
    }

    public function edit(int $id)
    {
        return view('admin.quiz.edit', [
            'quiz' => Quiz::where('id', $id)->first(),
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, int $id)
    {
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required|max:255'
        ]);

        $validatedData['category_id'] = $request->category_id;

        Quiz::where('id', $id)->first()->update($validatedData);
        // $quiz->update($request->all());

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
