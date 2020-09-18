<?php

namespace App\Http\Middleware;

use App\Article;
use App\Category;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class CategoriesShare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $categories = Category::with(['articles' => function($query) {
            $query->where('published', 1);
        }])->get();
        $nbArticles = count(Article::published()->get());
        if (Auth::check()) {
            $nbArticlesFavorites = count(Auth::user()->favoritesArticles);
            View::share(compact('categories', 'nbArticles', 'nbArticlesFavorites'));
        } else {
            View::share(compact('categories', 'nbArticles'));
        }
        return $next($request);
    }
}
