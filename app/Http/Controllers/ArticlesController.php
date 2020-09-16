<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ArticlesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($page = 1) {
        $articles = Article::published()->paginate(10, ['*'], 'page', $page);

        $currentPath = 'index_article';

        return view('articles.index', compact('articles', 'currentPath'));
    }

    public function indexByCategory($category, $page) {
        $articles = Article::published()->where('category_id', $category)->paginate(10, ['*'], 'page', $page);

        $currentPath = 'index_article_by_category';

        return view('articles.index', compact('articles', 'currentPath', 'category'));
    }

    public function new() {
        return view('articles.new');
    }

    public function store(ArticleRequest $request) {
        $imgName = uniqid('upload_') . '.' . $request->image->extension();

        if(!File::exists(public_path('images/upload/'))) {
            File::makeDirectory(public_path('images/upload/'));
        }

        File::move($request->image, 'images/upload/' . $imgName);
        $article = new Article($request->all());

        $article->image = $imgName;

        $article->save();

        return view('home');
    }

    public function show($id) {
        $article = Article::findOrFail($id);

        return view('articles.show', compact('article'));
    }
}
