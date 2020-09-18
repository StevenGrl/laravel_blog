<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Http\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

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

        $articles->load('category');

        $currentPath = 'index_article';

        $title = 'Liste des articles - Toutes catégories';

        return view('articles.index', compact('articles', 'currentPath', 'title'));
    }

    public function indexByCategory($category, $page) {
        $find_category = Category::find($category);

        $articles = Article::published()->where('category_id', $category)->paginate(10, ['*'], 'page', $page);

        $currentPath = 'index_article_by_category';

        $title = 'Liste des articles - ' . $find_category->name;

        return view('articles.index', compact('articles', 'currentPath', 'category', 'title'));
    }

    public function new() {
        $list_categories = Category::all()->pluck('name', 'id');
        return view('articles.new', compact('list_categories'));
    }

    public function store(ArticleRequest $request) {
        $imgName = uniqid('upload_') . '.' . $request->image->extension();

        if(!File::exists(public_path('images/upload/'))) {
            File::makeDirectory(public_path('images/upload/'));
        }

        File::move($request->image, 'images/upload/' . $imgName);
        $article = new Article($request->all());

        $article->image = $imgName;

        $article->nbViews = 0;

        $article->save();

        return view('home');
    }

    public function show($id) {
        $article = Article::findOrFail($id);

        $article->nbViews = $article->nbViews + 1;

        $article->save();

        $isLiked = Auth::user()->favoritesArticles->contains($article);

        return view('articles.show', compact('article', 'isLiked'));
    }

    public function like(Request $request, $article_id) {
        if(Auth::check()) {
            $user = Auth::user();

            $user->favoritesArticles()->attach($article_id);

            return response('Done');
        }
        return response('Unauthorized ', 401);
    }

    public function unlike(Request $request, $article_id) {
        if(Auth::check()) {
            $user = Auth::user();

            $user->favoritesArticles()->detach($article_id);

            return response('Done');
        }
        return response('Unauthorized ', 401);
    }
}
