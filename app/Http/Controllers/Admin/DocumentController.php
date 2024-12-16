<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    public function all()
    {
        return view('admin.documents.index', [
            'quizzes'   => Quiz::all(),
            'documents' => Document::all(),
        ]);
    }

    public function store(Request $request)
    {
        Document::create($request->all());

        return redirect()->back()->with('success', 'Đã thêm tài liệu thành công!');
    }

    public function edit(int $id)
    {
        return view('admin.documents.edit', [
            'document' => Document::find($id),
            'quizzes'  => Quiz::all(),
        ]);
    }

    public function update(int $id, Request $request)
    {
        Document::where('id', $id)->first()->update($request->all());

        return to_route('document.all');
    }

    public function deleteMultiple(Request $request)
    {
        Document::destroy($request->get('ids'));

        return response()->json(['message' => 'Question deleted successfully.']);
    }
}
