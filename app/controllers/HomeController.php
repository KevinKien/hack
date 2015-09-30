<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('tan123');
	}

	public function sitemap(){
		$allArticles = Article::join('article_category', 'articles.id', '=', 'article_category.article_id')
			->join('categories', 'categories.id', '=', 'article_category.category_id')
			->select(array('articles.*', 'categories.name as category_name', 'categories.alias as category_alias'))
			->where('articles.active',1)
			->groupBy('articles.id')
			->get();

		$allCates = Category::all();
		$content = View::make('sitemap', array(
			'allArticles' => $allArticles,
			'allCates' => $allCates
		));

		return Response::make($content)->header('Content-Type', 'text/xml;charset=utf-8');
	}

}
