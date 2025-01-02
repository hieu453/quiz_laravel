<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Imports\CategoriesImport;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;

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
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:categories',
            'image' => 'required|mimes:jpg,png,jpeg|mimetypes:image/jpeg,image/png,image/jpg',
        ]);
        $validatedData['slug'] = Str::slug($request->name) . '-' . Str::random();

        // get file name and extension
        $file = $validatedData['image']->getClientOriginalName();

        // get file name
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        // get file extension
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $finalFileName = "{$fileName}".Str::random().".{$fileExtension}";

        Category::create([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'image' => $finalFileName,
        ]);

        Storage::putFileAs('category_image', $validatedData['image'], $finalFileName);

        return to_route('category.all')->with('success', 'Đã thêm danh mục.');
    }

    public function importSpreadsheet()
    {
        return view('admin.categories.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'spreadsheet' => 'required'
        ]);

        try {
            Excel::import(new CategoriesImport, $request->file('spreadsheet'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            $message = '';
            foreach ($failures as $failure) {
                $message = "Tên danh mục '{$failure->values()['name']}' đã tồn tại! Kiểm tra lại dòng số {$failure->row()}";
                break;
            }
            return redirect()->back()->with('danger', $message);
        }
        return redirect()->back()->with('success', 'Nhập thành công!');
    }

    public function edit(int $id)
    {
        return view('admin.categories.edit', [
            'category' => Category::findOrFail($id)
        ]);
    }

    public function update(int $id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'image' => 'required|mimes:jpg,png,jpeg|mimetypes:image/jpeg,image/png,image/jpg',
        ]);
        $validatedData['slug'] = Str::slug($request->name) . '-' . Str::random();

        // get file name and extension
        $file = $validatedData['image']->getClientOriginalName();
        // get file name
        $fileName = pathinfo($file, PATHINFO_FILENAME);
        // get file extension
        $fileExtension = pathinfo($file, PATHINFO_EXTENSION);

        $finalFileName = "{$fileName}".Str::random().".{$fileExtension}";

        $category = Category::where('id', $id)->first();
        Storage::delete("category_image/{$category->image}");
        $category->update([
            'name' => $validatedData['name'],
            'slug' => $validatedData['slug'],
            'image' => $finalFileName,
        ]);

        Storage::putFileAs('category_image', $validatedData['image'], $finalFileName);

        return to_route('category.all')->with('success', 'Đã cập nhật danh mục.');
    }

    public function deleteMultiple(Request $request)
    {
        $categories = Category::find($request->get('ids'));

        if ($categories instanceof Collection) {
            foreach ($categories as $category) {
                Storage::delete("category_image/{$category->image}");
            }
        } else {
            Storage::delete("category_image/{$categories->image}");
        }

        Category::destroy($request->get('ids'));
        return response()->json(['message' => 'Delete category success!']);
    }
}
