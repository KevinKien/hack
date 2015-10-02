<?php

class FrontsController extends \BaseController {

	public function home(){
        $allArticles = Article::join('article_category', 'articles.id', '=', 'article_category.article_id')
            ->join('categories', 'categories.id', '=', 'article_category.category_id')
            ->select(array('articles.*', 'categories.name as category_name', 'categories.alias as category_alias'))
            ->where('articles.active',1)
            ->groupBy('articles.id')
            ->orderBy('articles.id','desc')
            ->paginate(10);
        return View::make('fronts.home')->with('allArticles', $allArticles);
    }

    public function getArticleList($cateSlug){
        $category = Category::where('alias', $cateSlug)->first();
        $allArticles = Article::join('article_category', 'articles.id', '=', 'article_category.article_id')
            ->join('categories', 'categories.id', '=', 'article_category.category_id')
            ->select(array('articles.*', 'categories.name as category_name'))
            ->where('article_category.category_id',$category->id)
            ->where('articles.active',1)
            ->groupBy('articles.id')
            ->orderBy('articles.id','desc')
            ->paginate(10);
        return View::make('fronts.article_list')->with('allArticles', $allArticles)->with('category', $category);
    }

    public function getArticleDetail($catSlug, $slug){
        $tmpArr = explode('-', $slug);
        $articleId = array_pop($tmpArr);
        $anArticle = Article::find($articleId);
        $category = Category::where('alias',$catSlug)->first();
        if(!$anArticle )
            throw new Exception('Không tìm thấy bài viết.');

        $allRelatedArticles = Article::join('article_category','articles.id','=','article_category.article_id')
            ->where('category_id', $category->id)
            ->where('articles.id', '!=', $articleId)
            ->orderBy('articles.id', 'desc')
            ->take(6)->get(array('articles.*'));

        return View::make('fronts.article_detail')->with('item', $anArticle)
            ->with('category', $category)
            ->with('allRelatedArticles', $allRelatedArticles);
    }

    public function getArticleByTag($tag){
        $allArticles = Article::join('article_category', 'articles.id', '=', 'article_category.article_id')
            ->join('categories', 'categories.id', '=', 'article_category.category_id')
            ->select(array('articles.*', 'categories.name as category_name', 'categories.alias as category_alias'))
            ->where('articles.active',1)
            ->where(function($query) use ($tag){
                $query->where('articles.keyword','LIKE', '%'.$tag.'%')->orWhere('articles.title','LIKE', '%'.$tag.'%');
            })
            ->groupBy('articles.id')
            ->orderBy('articles.id','desc')
            ->paginate(10);

        return View::make('fronts.tag')->with('allArticles', $allArticles)->with('tag', $tag);
    }

}