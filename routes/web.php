<?php

use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoteController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/vote');

Route::get('/elections', [ElectionController::class, 'index'])->name('elections.index');
Route::middleware('auth')->group(function () {
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('elections', ElectionController::class)->except(['index', 'show']);
    });
    Route::get('/elections/{id}', [ElectionController::class, 'show'])->name('elections.show');
});


Route::get('/candidates', [CandidateController::class, 'index'])->name('candidates.index');
Route::middleware('auth')->group(function () {
    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::resource('candidates', CandidateController::class)->except(['index', 'show']);
    });
    Route::get('/candidates/{id}', [CandidateController::class, 'show'])->name('candidates.show');
});



Route::middleware('auth')->group(function () {
    Route::get('/vote', [VoteController::class, 'index'])->name('vote.index');
    Route::post('/vote', [VoteController::class, 'store'])->name('vote.store');
    Route::get('/voted', [VoteController::class, 'voted'])->name('vote.voted');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/trends', function () {
    return view('trends.index');
})->name('trends.index');

require __DIR__ . '/auth.php';
