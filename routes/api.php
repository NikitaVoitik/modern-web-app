<?php

use App\Http\Controllers\API\ElectionCandidateController;
use App\Http\Controllers\API\VoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnforceAcceptHeader;

Route::middleware(['api'])->group(function () {
    Route::get('/election-candidates', [ElectionCandidateController::class, 'index']);
    Route::get('/election-candidates/{electionCandidate}', [ElectionCandidateController::class, 'show']);
    Route::delete('/election-candidates/{electionCandidate}', [ElectionCandidateController::class, 'destroy']);

    Route::resource('/votes', VoteController::class);
});
