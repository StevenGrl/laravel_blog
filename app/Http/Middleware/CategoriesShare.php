<?php

namespace App\Http\Middleware;

use App\Article;
use App\Category;
use Closure;
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
        $categories = Category::all();
        $nbArticles = count(Article::published()->get());
        View::share(compact('categories', 'nbArticles'));
        return $next($request);
    }
}
