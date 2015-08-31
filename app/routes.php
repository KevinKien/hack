<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'FrontsController@home');
Route::get('/tag/{tag}', 'FrontsController@getArticleByTag');

Route::get('admin', 'AdminBaseController@index');
Route::controller('admin/articles', 'ArticlesController');
Route::controller('admin/categories', 'CategoriesController');

Route::controller('user', 'UsersController');
Route::controller('charge', 'TxnsController');

Route::get('/{cateSlug}/{slug}.html', 'FrontsController@getArticleDetail');
Route::get('/{cateSlug}', 'FrontsController@getArticleList');

Route::group(array('before' => 'auth'), function()
{
    \Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
    \Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
});
