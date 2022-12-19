<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $articles = Article::select('id', 'title', 'slug', 'writer', 'image', 'status', 'delete', 'content')
            ->with('tags:id,name,color,background')
            ->where('delete', '=', '0')
            ->where('status', '=', '1')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('home', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::with('tags')->where('slug', '=', $slug)->first();
        return view('details', compact('article'));
    }
}
