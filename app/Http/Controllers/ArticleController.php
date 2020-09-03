<?php

namespace App\Http\Controllers;

use App\Models\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::where('category_id', 2)->get();

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article)
    {
        $article->increment('click');

        return view('articles.show', compact('article'));
    }

    //经文共修
    public function meditation()
    {
        $article = Article::where('category_id', 1)->first();
        $article->increment('click');

        return view('articles.show', compact('article'));
    }
}
