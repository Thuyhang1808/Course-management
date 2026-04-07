<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;



// Dashboard
Route::get('/', [CourseController::class, 'dashboard'])->name('dashboard');

// Course routes

Route::resource('courses', CourseController::class);
Route::get('courses/trashed', [CourseController::class, 'trashed'])->name('courses.trashed');
Route::post('courses/{id}/restore', [CourseController::class, 'restore'])->name('courses.restore');



// Lesson routes (nested under courses)
Route::prefix('courses/{course}')->group(function () {
    Route::get('/lessons', [LessonController::class, 'index'])->name('courses.lessons.index');
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('courses.lessons.create');
    Route::post('/lessons', [LessonController::class, 'store'])->name('courses.lessons.store');
});

// Lesson routes (standalone)
Route::get('lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
Route::put('lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
Route::delete('lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

// Enrollment routes
Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
Route::get('enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');
Route::delete('enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');