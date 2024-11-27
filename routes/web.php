<?php


use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Notifications\NewAnnouncement;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIfUserIsAdmin;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminCategoryController;

// Get all users who commented on post
// $comments = Comment::where('quiz_id', 7)->get();
// $users = $comments->map->user->unique('id');


Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/test', function () {
    $comments = Comment::where('quiz_id', 25)->get();
    $users = $comments->map->user->unique('id')->except(Auth::user()->id);
    return view('home.quiz.index');
});
Route::get('/categories', [CategoryController::class, 'all'])->name('home.category.all');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('home.category.show');

Route::get('/quiz/{id}/detail', [HomeController::class, 'quizDetail'])->name('quiz.detail');

// Route::get('/test', function (Request $request) {

//     $quiz = Quiz::where('id', 7)->first();
//     $comments = Comment::whereNull('parent_id')->orderBy('created_at', 'DESC')->paginate(2);
//     // $replies = Comment::whereNotNull('parent_id')->get();
//     $quiz_id = $quiz->id;

//     if ($request->ajax()) {
//         $view = view('home.quiz.comments.comments', compact('comments', 'quiz_id'))->render();

//         return response()->json(['html' => $view]);
//     }

//     return view('home.quiz.comments.index', [
//         'quiz'      =>  $quiz,
//         'comments'  =>  $comments,
//     ]);
// })->name('comments.index');

// Route::get('/more-comments', [CommentController::class, 'showMoreComment'])->name('comments.index');


Route::middleware('auth')->group(function () {
    Route::get('/send', function () {
        $messages = [
            'title'     => 'Hello World',
            'body'      => 'This is a text',
            'link'      => '',
            'linkText'  => ''
        ];

        $user = User::where('is_admin', 0)->first();

        // $user->notify(new NewAnnouncement($messages));
    });

    Route::get('/unread-notifications', function () {
        return Auth::user()->unreadNotifications->count();
    });


    Route::get('/quiz/{id}/start', [HomeController::class, 'startQuizQuestions'])->name('quiz.start');
    Route::post('/check-result', [HomeController::class, 'checkResult'])->name('checkResult');
    Route::get('/show-correct-answer/quiz/{id}', [HomeController::class, 'showCorrectAnswer'])->name('show.correct');

    Route::post('/comment-store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment-update/{id}', [CommentController::class, 'update'])->name('comment.update');

    Route::get('/notification/{id}', [NotificationController::class, 'index'])->name('notification.index');
});

Route::prefix('admin')->middleware(['auth', CheckIfUserIsAdmin::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    //Categories routes
    Route::get('/category-all', [AdminCategoryController::class, 'all'])->name('category.all');
    Route::post('/category-store', [AdminCategoryController::class, 'store'])->name('category.store');
    Route::delete('category-delete/{id}', [AdminCategoryController::class, 'destroy'])->name('category.delete');
    Route::delete('/category-deleteMultiple', [AdminCategoryController::class, 'deleteMultiple'])->name('category.deleteMultiple');
    Route::get('/category-edit/{id}', [AdminCategoryController::class, 'edit'])->name('category.edit');
    Route::put('/category-update/{id}', [AdminCategoryController::class, 'update'])->name('category.update');
    Route::delete('/category-deleteMultiple', [AdminCategoryController::class, 'deleteMultiple'])->name('category.deleteMultiple');
    Route::get('/category-import', [AdminCategoryController::class, 'importSpreadsheet'])->name('category.import');
    Route::post('/category-import', [AdminCategoryController::class, 'import'])->name('category.import.store');

    //Quiz routes
    Route::get('/quiz-all', [QuizController::class, 'all'])->name('quiz.all');
    Route::get('/quiz-import', [QuizController::class, 'importSpreadsheet'])->name('quiz.import');
    Route::post('/quiz-import', [QuizController::class, 'import'])->name('quiz.import.store');
    Route::get('/quiz-edit/{id}', [QuizController::class, 'edit'])->name('quiz.edit');
    Route::put('/quiz-update/{id}', [QuizController::class, 'update'])->name('quiz.update');
    Route::post('/quiz-store', [QuizController::class, 'store'])->name('quiz.store');
    // Route::delete('quiz-delete/{id}', [QuizController::class, 'destroy'])->name('quiz.delete');
    Route::delete('/quiz-deleteMultiple', [QuizController::class, 'deleteMultiple'])->name('quiz.deleteMultiple');

    //Question routes
    Route::get('/question-all', [QuestionController::class, 'all'])->name('question.all');
    Route::get('/question-import', [QuestionController::class, 'importSpreadsheet'])->name('question.import');
    Route::post('/question-import', [QuestionController::class, 'import'])->name('question.import.store');
    Route::post('/question-store', [QuestionController::class, 'store'])->name('question.store');
    Route::get('/question-edit/{id}', [QuestionController::class, 'edit'])->name('question.edit');
    Route::post('/question-update/{id}', [QuestionController::class, 'update'])->name('question.update');
    Route::delete('/question-delete/{id}', [QuestionController::class, 'destroy'])->name('question.delete');
    Route::delete('/question-deleteMultiple', [QuestionController::class, 'deleteMultiple'])->name('question.deleteMultiple');

    //Option routes
    Route::get('/option-create', [OptionController::class, 'create'])->name('option.create');
    Route::post('/option-store', [OptionController::class, 'store'])->name('option.store');

    Route::get('/activities', [\App\Http\Controllers\ActivitiesController::class, 'activities'])->name('activities');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

