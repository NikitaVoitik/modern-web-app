<?php

namespace App\Models;

use Database\Factories\VoteFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    public $timestamps = false;
    /** @use HasFactory<VoteFactory> */
    use HasFactory;
}
