<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function all()
    {
        return view('admin.documents.index', [
            'documents' => Document::all(),
        ]);
    }

    public function edit()
    {

    }
}
