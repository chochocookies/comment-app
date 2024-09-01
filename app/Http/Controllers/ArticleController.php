<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return view('articles.index', [
            'articles' => Article::withCount('comments')->with('user')->latest()->get()
        ]);

    }
    public function show($slug)
    {
        return view('articles.show', [
            'article' => Article::with('user')->where('slug',$slug)->first()

        ]);
    }
}
