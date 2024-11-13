<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class WelcomController extends Controller
{
    public function __invoke()
    {
        $articles = Article::whereNotNull('published_at')->orderBy('published_at', 'desc')->get();
        return view('welcome', compact('articles'));
    }
}
