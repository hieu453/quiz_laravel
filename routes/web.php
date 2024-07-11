<?php

use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Admin\QuizController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/quiz/{id}', [HomeController::class, 'showQuizQuestions'])->name('quiz.questions.show');
Route::post('/check-result', [HomeController::class, 'checkResult'])->name('checkResult');


Route::prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/question-all', [QuestionController::class, 'all'])->name('question.all');
    Route::get('/question-create', [QuestionController::class, 'create'])->name('question.create');
    Route::get('/question-import', [QuestionController::class, 'importSpreadsheet'])->name('question.import');
    Route::post('/question-import', [QuestionController::class, 'import'])->name('question.import.store');
    Route::post('/question-store', [QuestionController::class, 'store'])->name('question.store');

    Route::get('/quiz-all', [QuizController::class, 'all'])->name('quiz.all');
    Route::get('/quiz-create', [QuizController::class, 'create'])->name('quiz.create');
    Route::get('/quiz-import', [QuizController::class, 'importSpreadsheet'])->name('quiz.import');
    Route::post('/quiz-import', [QuizController::class, 'import'])->name('quiz.import.store');
    Route::post('/quiz-store', [QuizController::class, 'store'])->name('quiz.store');

    Route::get('/option-create', [OptionController::class, 'create'])->name('option.create');
    Route::post('/option-store', [OptionController::class, 'store'])->name('option.store');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

