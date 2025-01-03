<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function all()
    {
        return view('home.categories.index', [
            'categories' => Category::where('status', 1)->get(),
        ]);
    }

    public function search(Request $request)
    {
        $categories = Category::where('name', 'like', "%{$request->get('c')}%")->get();

        return view('home.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function show($slug)
    {
        return view('home.categories.show', [
            // 'categories' => Category::all(),
            'category'   => Category::where('slug', $slug)->first(),
        ]);
    }
}
