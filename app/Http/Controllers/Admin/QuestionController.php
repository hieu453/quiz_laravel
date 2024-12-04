<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\QuestionImport;
use App\Models\Option;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    public function all()
    {
        $questions = Question::all();
        $quizzes = Quiz::all();

        return view('admin.question.index', compact('questions', 'quizzes'));
    }

    public function store(Request $request)
    {
        $quiz = Quiz::where('id', $request->get('quiz_id'))->first();
        $quiz->has_questions = 1;
        $quiz->save();

        $validatedData = $request->validate([
            'title' => 'required|max:255'
        ]);
        $validatedData['quiz_id'] = $request->get('quiz_id');

        Question::create($validatedData);

        return redirect()->route('question.all');
    }

    public function importSpreadsheet()
    {
        $quizzes = Quiz::all();

        return view('admin.question.import', compact('quizzes'));
    }

    public function import(Request $request)
    {
        Excel::import(new QuestionImport($request->get('quiz_id')), $request->file('spreadsheet'));

        return redirect()->back()->with('success', 'Đã import thành công!.');
    }

    public function edit(int $id)
    {
        $question = Question::where('id', $id)->first();
        $quizzes = Quiz::all();

        return view('admin.question.edit', compact('question', 'quizzes'));
    }

    public function update(int $id, Request $request)
    {
        // dd($request->all());
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'options' => 'required|max:255'
        ]);
        $validatedData['quiz_id'] = $request->quiz_id;
        // dd($validatedData);
        // $question = Question::find($id);
        // $question->title = $request->title;
        // $question->quiz_id = $request->quiz_id;
        // $question->save();

        Question::where('id', $id)->first()->update($validatedData);

        foreach ($request->options as $option) {
            if ($option['text'] == null) {
                return redirect()->back()->withErrors(['errors' => 'Phải điền hết trường lựa chọn']);
            }
            // kiem tra neu id cua cau hoi trung voi id cau hoi dung thi cap nhat, get('correct') la id cau hoi dung
            if ($option['option_id'] == $request->get('correct')) {
                Option::where('id', $request->get('correct'))->update([
                    'text' => $option['text'],
                    'is_correct' => 1
                ]);
                continue;
            } else {
                Option::where('id', $option['option_id'])->update([
                    'text' => $option['text'],
                    'is_correct' => 0
                ]);
            }
        }

        return redirect()->route('question.all');
    }

    public function destroy(int $id)
    {
        Question::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Question deleted successfully.');
    }

    public function deleteMultiple(Request $request)
    {
        Question::destroy($request->get('ids'));

        return response()->json(['message' => 'Question deleted successfully.']);
    }
}
