<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SubmissionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Redirect dashboard to home
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Placeholder routes for navbar links
Route::get('/plants', function () {
    return view('plants.index');
})->name('plants.index');

Route::get('/articles', function () {
    return view('articles.index');
})->name('articles.index');

Route::get('/articles/{slug}', function ($slug) {
    $article = \App\Models\Article::where('slug', $slug)->firstOrFail();
    return view('articles.show', compact('article'));
})->name('articles.show');

Route::middleware('auth')->group(function () {
    // Dummy routes for backward compatibility (redirect to home with modal trigger)
    Route::get('/reports/create', function () {
        return redirect()->route('home')->with('openModal', 'report');
    })->name('reports.create');

    Route::get('/submissions/create', function () {
        return redirect()->route('home')->with('openModal', 'submission');
    })->name('submissions.create');

    // Add POST routes for actual submission handling
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
});

require __DIR__ . '/auth.php';
