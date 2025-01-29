<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\VoteResource;
use App\Models\Vote;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $votes = Vote::all();
        return VoteResource::collection($votes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|integer',
            'election_candidate_id' => 'required|integer|exists:election_candidates,id',
        ]);

        $vote = Vote::create($validatedData);

        return new VoteResource($vote);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vote = Vote::findOrFail($id);
        return new VoteResource($vote);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'election_candidate_id' => 'required|integer|exists:election_candidates,id',
        ]);
        $vote = Vote::findOrFail($id);
        $vote->update($validatedData);

        return new VoteResource($vote);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vote = Vote::findOrFail($id);
        $vote->delete();

        return response()->json(null, 204);
    }
}
