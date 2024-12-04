<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class UserPlayed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userPlayed = UserPoint::where('user_id', Auth::user()->id)->first();
        if ($userPlayed) {
            return $next($request);
        }
        Session::flash('message', 'Bạn chưa làm bài nên không được xem đáp án!');
        return to_route('index');
    }
}
