<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\ElectionCandidate;

class ElectionCandidateController extends Controller
{
    public function index()
    {
        $electionCandidates = ElectionCandidate::with(['election', 'candidate'])->get()->map(function ($electionCandidate) {
            return [
                'id' => $electionCandidate->id,
                'election' => $electionCandidate->election->id,
                'candidate' => $electionCandidate->candidate->name,
            ];
        });

        return response()->json($electionCandidates);
    }

    public function show(ElectionCandidate $electionCandidate)
    {
        $electionCandidate->load(['election', 'candidate']);

        return response()->json([
            'id' => $electionCandidate->id,
            'election' => $electionCandidate->election->id,
            'candidate' => $electionCandidate->candidate->name,
        ]);
    }
}
