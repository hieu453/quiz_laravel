<?php


use Illuminate\Http\Request;
use App\Http\Middleware\UserPlayed;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckIfUserIsAdmin;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminCategoryController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::delete('/test', function (Request $request) {
    dd($request->all());
});
Route::get('/categories', [CategoryController::class, 'all'])->name('home.category.all');
Route::get('/categories/search', [CategoryController::class, 'search'])->name('home.category.search');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('home.category.show');

Route::get('/quiz/{id}/detail', [HomeController::class, 'quizDetail'])->name('quiz.detail');

Route::middleware('auth')->group(function () {
    Route::get('/set-quetions-to-session/{id}', [HomeController::class, 'setQuestionsToSession'])->name('questions.session');
    Route::get('/quiz/{id}/start', [HomeController::class, 'startQuizQuestions'])->name('quiz.start');
    Route::post('/check-result', [HomeController::class, 'checkResult'])->name('checkResult');
    Route::get('/show-correct-answer/quiz/{id}', [HomeController::class, 'showCorrectAnswer'])->middleware(UserPlayed::class)->name('show.correct');

    Route::post('/comment-store', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment-update/{id}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('comment-delete', [CommentController::class, 'destroy'])->name('comment.destroy');

    Route::post('/send-feedback', [FeedbackController::class, 'sendFeedback'])->name('feedback.send');

    Route::get('/notification/user', [NotificationController::class, 'all'])->name('notification.user');
});

Route::prefix('admin')->middleware(['auth', CheckIfUserIsAdmin::class])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/notification/admin', [NotificationController::class, 'all'])->name('notification.admin');

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
    Route::put('/question-update/{id}', [QuestionController::class, 'update'])->name('question.update');
    // Route::delete('/question-delete/{id}', [QuestionController::class, 'destroy'])->name('question.delete');
    Route::delete('/question-deleteMultiple', [QuestionController::class, 'deleteMultiple'])->name('question.deleteMultiple');

    //Option routes
    Route::get('/option-create', [OptionController::class, 'create'])->name('option.create');
    Route::post('/option-store', [OptionController::class, 'store'])->name('option.store');

    //Users routes
    Route::get('/user-all', [UserController::class, 'all'])->name('user.all');
    Route::post('/user-store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user-update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/user-update-password/{id}', [UserController::class, 'updatePassword'])->name('user.update.password');
    Route::delete('/user-deleteMultiple', [UserController::class, 'deleteMultiple'])->name('user.deleteMultiple');

    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback');
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

