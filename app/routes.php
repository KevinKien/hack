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
Route::get('/captcha', 'CaptchaController@getBuild');
Route::get('/nap-so-garena.html', 'TxnsController@getChargeGarena');

Route::get('/{cateSlug}/{slug}.html', array(
    'as' =>'article',
    'uses' => 'FrontsController@getArticleDetail'
));
Route::get('/{cateSlug}.html', array(
    'as' => 'category',
    'uses'=>'FrontsController@getArticleList'
));

Route::group(array('before' => 'auth'), function()
{
    \Route::get('elfinder', 'Barryvdh\Elfinder\ElfinderController@showIndex');
    \Route::any('elfinder/connector', 'Barryvdh\Elfinder\ElfinderController@showConnector');
});

Route::get('sitemap.xml', array(
    'as'=>'sitemap',
    'uses'=>'HomeController@sitemap'
));
