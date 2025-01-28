<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ElectionCandidateResource;
use App\Models\ElectionCandidate;

class ElectionCandidateController extends Controller
{
    public function index()
    {
        $electionCandidates = ElectionCandidate::with(['election', 'candidate'])->get();

        return ElectionCandidateResource::collection($electionCandidates);
    }

    public function show(ElectionCandidate $electionCandidate)
    {
        $electionCandidate->load(['election', 'candidate']);

        return new ElectionCandidateResource($electionCandidate);
    }
}
