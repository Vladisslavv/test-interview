<?php

use App\Http\Controllers\SavedContentController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('saved-content', [SavedContentController::class, 'index'])->name('saved-content.index');
    Route::get('saved-content/create', [SavedContentController::class, 'create'])->name('saved-content.create');
    Route::post('saved-content', [SavedContentController::class, 'generateText'])->name('saved-content.generate');
    Route::get('saved-content/{content}', [SavedContentController::class, 'show'])->name('saved-content.view');
    Route::delete('saved-content/{content}', [SavedContentController::class, 'destroy'])->name('saved-content.destroy');
});

require __DIR__.'/settings.php';
