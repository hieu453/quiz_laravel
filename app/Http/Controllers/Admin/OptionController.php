<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\Question;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    public function create()
    {
        $questions = Question::where('has_options', 0)->get();

        return view('admin.option.create', compact('questions'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        foreach ($request->get('options') as $key => $option) {
            if ($option['text'] == null) {
                return redirect()->back()->with(['error' => 'Phải điền hết trường lựa chọn']);
            }

            if ($key == $request->correct) {
                Option::create([
                    'question_id' => $request->get('question_id'),
                    'text' => $option['text'],
                    'is_correct' => 1,
                ]);

            } else {
                Option::create([
                    'question_id' => $request->get('question_id'),
                    'text' => $option['text'],
                ]);
            }
        }

        $request->validate([
            'correct' => 'required'
        ]);

        $question = Question::findOrFail($request->get('question_id'));
        $question->has_options = 1;
        $question->save();

        return redirect()->back()->with('success', 'Option added');
    }
}
