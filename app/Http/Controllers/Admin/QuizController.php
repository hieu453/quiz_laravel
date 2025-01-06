<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Category;
use Illuminate\View\View;
use App\Imports\QuizImport;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;

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
            'title'       => 'required|max:255|unique:quizzes',
            'description' => 'required|max:255',
            'image' => 'required|mimes:jpg,png,jpeg|mimetypes:image/jpeg,image/png,image/jpg',
            'status' => 'required',
        ]);
        $validatedData['category_id'] = $request->category_id;
        // $validatedData['has_questions'] = 0;

        // get file name and extension
        $file = $validatedData['image']->getClientOriginalName();
        // get file name
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        // get file extension
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $finalFileName = "{$fileName}".Str::random().".{$fileExtension}";

        Quiz::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            // 'has_questions' => $validatedData['has_questions'],
            'status' => $validatedData['status'],
            'image' => $finalFileName,
        ]);

        Storage::putFileAs('quiz_image', $validatedData['image'], $finalFileName);

        return to_route('quiz.all')->with('success', 'Đã thêm môn học.');
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
            'description' => 'required|max:255',
            'image' => 'required|mimes:jpg,png,jpeg|mimetypes:image/jpeg,image/png,image/jpg',
        ]);

        $validatedData['category_id'] = $request->category_id;
        $validatedData['time'] = (int)$request->time;
        $validatedData['status'] = (int)$request->status;

        $file = $validatedData['image']->getClientOriginalName();
        // get file name
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        // get file extension
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $finalFileName = "{$fileName}".Str::random().".{$fileExtension}";

        $quiz = Quiz::where('id', $id)->first();
        Storage::delete("quiz_image/{$quiz->image}");
        $quiz->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'category_id' => $validatedData['category_id'],
            'time' => $validatedData['time'],
            'status' => $validatedData['status'],
            'image' => $finalFileName,
        ]);
        Storage::putFileAs('quiz_image', $validatedData['image'], $finalFileName);

        return to_route('quiz.all')->with('success', 'Đã cập nhật môn học.');
    }

    // public function destroy(int $id)
    // {
    //     Quiz::where('id', $id)->delete();

    //     return redirect()->back()->with('success', 'Delete success!');
    // }

    public function deleteMultiple(Request $request)
    {
        $quizzes = Quiz::find($request->get('ids'));

        if ($quizzes instanceof Collection) {
            foreach ($quizzes as $quiz) {
                Storage::delete("quiz_image/{$quiz->image}");
            }
        } else {
            Storage::delete("quiz_image/{$quizzes->image}");
        }

        Quiz::destroy($request->get('ids'));

        return response()->json(['message' => 'Delete quiz success!']);
    }
}
