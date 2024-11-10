<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\CategoriesImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminCategoryController extends Controller
{
    public function all()
    {
        $categories = Category::all();

        return view('admin.categories.index', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random()
        ]);

        return to_route('category.all');
    }

    public function importSpreadsheet()
    {
        return view('admin.categories.import');
    }

    public function import(Request $request)
    {
        Excel::import(new CategoriesImport, $request->file('spreadsheet'));

        return redirect()->back()->with('success', 'Import success!');
    }

    public function edit(int $id)
    {
        return view('admin.categories.edit', [
            'category' => Category::findOrFail($id)
        ]);
    }

    public function update(int $id, Request $request)
    {
        Category::where('id', $id)->first()->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name) . '-' . Str::random()
        ]);

        return to_route('category.all');
    }

    // public function destroy()
    // {

    // }

    public function deleteMultiple(Request $request)
    {
        Category::destroy($request->get('ids'));
        return response()->json(['message' => 'Delete category success!']);
    }
}
