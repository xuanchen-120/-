<?php

namespace App\Admin\Controllers;

use App\Admin\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $title    = $request->title;
        $articles = Article::when($title, function ($query) use ($title) {
            $query->where('title', 'like', "%{$title}%");
        })
            ->orderBy('id', 'desc')->paginate(15);

        return view('Admin::articles.index', compact('articles'));
    }

    public function create()
    {
        $category_list = Category::treeShow(0, 'article');
        return view('Admin::articles.create', compact('category_list'));
    }

    public function store(ArticleRequest $request)
    {
        $result = Article::create($request->all());
        if ($result) {
            return $this->success('文章添加成功', route('Admin.articles.index'));
        } else {
            return $this->error();
        }
    }

    public function edit(Article $article)
    {
        $category_list = Category::treeShow(0, 'article');
        return view('Admin::articles.edit', compact('article', 'category_list'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        if ($article->update($request->all())) {
            return $this->success('文章更新成功', route('Admin.articles.index'));
        } else {
            return $this->error();
        }
    }

    public function destroy(Article $article)
    {
        if ($article->delete()) {
            return $this->success();
        } else {
            return $this->error();
        }
    }
}
