<?php

use App\Http\Controllers\ElectionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/elections', [ElectionController::class, 'index'])->name('elections.index');
Route::get('/elections/{id}', [ElectionController::class, 'show'])->name('elections.show');

Route::get('/candidates', [CandidateController::class, 'index'])->name('elections.index');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
