<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/admin/dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/about', [AboutController::class, 'index']);

    Route::resource('student', StudentsController::class)->except('show');
    Route::resource('classroom', ClassroomController::class)->except('show');
    Route::resource('subject', SubjectController::class)->except('show');
    Route::resource('teacher', TeacherController::class)->except('show');
});
