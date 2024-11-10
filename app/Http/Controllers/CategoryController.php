<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function all()
    {
        return view('home.categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function show($slug)
    {
        // dd(Category::where('slug', $slug)->first());
        return view('home.categories.show', [
            'categories' => Category::all(),
            'category'   => Category::where('slug', $slug)->first()
        ]);
    }
}
