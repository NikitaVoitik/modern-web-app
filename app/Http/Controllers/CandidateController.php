<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function index()
    {
        $candidates = Candidate::with('elections')
            ->withCount('elections')
            ->orderBy('elections_count', 'desc')
            ->orderBy('party', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('candidates.index', compact('candidates'));
    }


    public function show(int $id)
    {

    }
}
