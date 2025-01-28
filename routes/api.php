<?php

use App\Http\Controllers\API\ElectionCandidateController;
use Illuminate\Support\Facades\Route;


Route::get('/election-candidates', [ElectionCandidateController::class, 'index']);
Route::get('/election-candidates/{electionCandidate}', [ElectionCandidateController::class, 'show']);
Route::delete('/election-candidates/{electionCandidate}', [ElectionCandidateController::class, 'destroy']);
