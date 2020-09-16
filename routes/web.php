<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => 'CategoriesShare'], function(){
    Route::get('/', ['as' => 'home', 'uses' => function () {
        return view('home');
    }]);

    Route::get('/articles/new', ['as' => 'new_article', 'uses' => 'ArticlesController@new']);
    Route::get('/articles/show/{id}', ['as' => 'show_article', 'uses' => 'ArticlesController@show']);
    Route::get('/articles/index/{page}', ['as' => 'index_article', 'uses' => 'ArticlesController@index']);
    Route::get('/articles/index/{category}/{page}', ['as' => 'index_article_by_category', 'uses' => 'ArticlesController@indexByCategory']);

    Route::post('/articles/store', ['as' => 'store_article', 'uses' => 'ArticlesController@store']);
});

Auth::routes();
