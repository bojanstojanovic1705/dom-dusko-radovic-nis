<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $news = News::published()
            ->with('images')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('home', compact('news'));
    }
}
