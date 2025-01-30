<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ElectionCandidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        ray($this);
        return [
            'id' => $this->id,
            'election' => $this->election_id,
            'candidate' => $this->candidate_name,
        ];
    }
}
