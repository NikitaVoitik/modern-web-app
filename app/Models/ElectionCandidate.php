<?php

namespace App\Models;

use Database\Factories\ElectionCandidateFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ElectionCandidate extends Model
{
    /** @use HasFactory<ElectionCandidateFactory> */
    use HasFactory;
}
