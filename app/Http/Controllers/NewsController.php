<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::published()
            ->with('images')
            ->latest('published_at')
            ->paginate(9);

        return view('news.index', compact('news'));
    }

    public function show($slug)
    {
        $news = News::where('slug', $slug)
            ->published()
            ->with('images')
            ->firstOrFail();

        return view('news.show', compact('news'));
    }
}
