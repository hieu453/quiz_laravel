<?php

namespace App\Http\Controllers\Admin;

use App\Models\Quiz;
use App\Models\User;
use App\Models\Category;
use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Models\UserPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $numberOfQuizzes = Quiz::all()->count();
        $numberOfQuestions = Question::all()->count();
        $numberOfCategories = Category::all()->count();
        $numberOfUsers = User::all()->count();

        $quizzes = Quiz::all();



        if ($request->ajax()) {
            $quiz_id = $request->quiz_id ? $request->quiz_id : 1;
            if ($quiz_id) {
                $userPoints = UserPoint::where('quiz_id', $quiz_id)->get();
                $userPointsDistinct = DB::table('user_points')
                                            ->select('points')
                                            ->where('quiz_id', $quiz_id)
                                            ->distinct()
                                            ->orderBy('points' ,'asc')
                                            ->get();
                return response()->json([
                    'userPointsData' => $userPoints,
                    'userPointsDistinct' => $userPointsDistinct
                ]);
            }
        } else {
            $userPoints = UserPoint::all();
            $userPointsDistinct = DB::table('user_points')
                                        ->select('points')
                                        ->distinct()
                                        ->orderBy('points' ,'asc')
                                        ->get();
        }

        return view('admin.dashboard', [
            'numberOfQuizzes'       => $numberOfQuizzes,
            'numberOfQuestions'     => $numberOfQuestions,
            'numberOfCategories'    => $numberOfCategories,
            'numberOfUsers'         => $numberOfUsers,
            'userPoints'            => $userPoints,
            'userPointsDistinct'    => $userPointsDistinct,
            'quizzes'               => $quizzes
        ]);
    }
}
