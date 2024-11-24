<?php

namespace App\Http\Controllers;

use App\Models\Election;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        $elections = Election::live()->get();
        return view('vote.index', compact('elections'));
    }
}
