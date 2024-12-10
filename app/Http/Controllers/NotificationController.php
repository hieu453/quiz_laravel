<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function all(Request $request)
    {
        if ($request->user()->is_admin == 1) {
            return view('notification.admin');
        }

        return view('notification.user');
    }
}
