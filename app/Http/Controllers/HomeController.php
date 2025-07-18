<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Forest;
use App\Models\Plant;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get latest articles for homepage
        $articles = Article::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // Get statistics for hero section
        $stats = [
            'forests' => Forest::count(),
            'plants' => Plant::count(),
            'articles' => Article::count(),
            'users' => User::count(),
        ];

        // Get forests for modal dropdown
        $forests = Forest::select('id', 'name')->get();

        return view('home', compact('articles', 'stats', 'forests'));
    }
}
