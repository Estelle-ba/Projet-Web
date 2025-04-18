<?php

use App\Http\Controllers\CohortController;
use App\Http\Controllers\CommonLifeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RetroController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\KnowledgeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CommentTaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssistantController;

// Redirect the root path to /dashboard
Route::redirect('/', 'dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Cohorts
        Route::get('/cohorts', [CohortController::class, 'index'])->name('cohort.index');
        Route::get('/cohort/{cohort}', [CohortController::class, 'show'])->name('cohort.show');

        // Teachers
        Route::get('/teachers', [TeacherController::class, 'index'])->name('teacher.index');

        // Students
        Route::get('students', [StudentController::class, 'index'])->name('student.index');

        // Knowledge
        Route::get('knowledge', [KnowledgeController::class, 'index'])->name('knowledge.index');
        Route::post('knowledge', [KnowledgeController::class, 'resultTest'])->name('knowledge.result');
        Route::post('knowledge-modify', [KnowledgeController::class, 'modifyTest'])->name('test.modify');
        Route::post('knowledge-delete', [KnowledgeController::class, 'deleteTest'])->name('test.delete');
        Route::post('knowledge-cohort-modify', [KnowledgeController::class, 'delete_cohort'])->name('test.cohort-delete');


        // Groups
        Route::get('groups', [GroupController::class, 'index'])->name('group.index');

        // Retro
        route::get('retros', [RetroController::class, 'index'])->name('retro.index');

        // Common life
        Route::get('common-life', [CommonLifeController::class, 'index'])->name('common-life.index');
        Route::post('common-life-create', [CommonLifeController::class, 'create'])->name('common-life.create')->middleware('can:create,App\Models\CommonLife');
        Route::post('common-life-delete', [CommonLifeController::class, 'delete'])->name('common-life.delete');
        Route::post('common-life-modify', [CommonLifeController::class, 'modify_task'])->name('common-life.modify');
        Route::post('common-life-cohort-modify', [CommonLifeController::class, 'delete_cohort'])->name('common-life.cohort-delete');

        //Comment Common Life
        Route::post('comment-add', [CommentTaskController::class, 'addComment'])->name('comment-add');
        Route::post('comment-modify', [CommentTaskController::class, 'modifyComment'])->name('comment-modify')->middleware('can:modify,App\Models\CommentTask');
        Route::post('comment-delete', [CommentTaskController::class, 'deleteComment'])->name('comment-delete')->middleware('can:modify,App\Models\CommentTask');

        // api.test
        Route::post('/generate-text', [AssistantController::class, 'generateText'])->name('generateText');
    });

});

require __DIR__.'/auth.php';
