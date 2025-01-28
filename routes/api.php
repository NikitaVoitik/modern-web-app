<?php

use App\Http\Controllers\API\ElectionCandidateController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnforceAcceptHeader;

Route::middleware(['api'])->group(function () {
    Route::get('/election-candidates', [ElectionCandidateController::class, 'index']);
    Route::get('/election-candidates/{electionCandidate}', [ElectionCandidateController::class, 'show'])->middleware(EnforceAcceptHeader::class);
    Route::delete('/election-candidates/{electionCandidate}', [ElectionCandidateController::class, 'destroy']);
});
