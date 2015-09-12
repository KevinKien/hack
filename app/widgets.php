<?php

Widget::register('aside', function(){
    $articleHotList = Article::join('article_category', 'articles.id', '=', 'article_category.article_id')
        ->join('categories', 'categories.id', '=', 'article_category.category_id')
        ->select(array('articles.*', 'categories.name as category_name', 'categories.alias as category_alias'))
        ->where('articles.active',1)
        ->where('articles.is_hot',1)
        ->groupBy('articles.id')
        ->orderBy('articles.id','desc')
        ->paginate(10);

    $articleNewList = Article::join('article_category', 'articles.id', '=', 'article_category.article_id')
        ->join('categories', 'categories.id', '=', 'article_category.category_id')
        ->select(array('articles.*', 'categories.name as category_name', 'categories.alias as category_alias'))
        ->where('articles.active',1)
        ->groupBy('articles.id')
        ->orderBy('articles.id','desc')
        ->paginate(10);
    return View::make('widgets.aside', array(
        'articleHotList' => $articleHotList,
        'articleNewList' => $articleNewList
    ));
});

use Gregwar\Captcha\CaptchaBuilder;
Widget::register('captcha',function(){
    $builder = new CaptchaBuilder;
    $builder->setIgnoreAllEffects(true);
    $builder->build();
    $captcha = $builder->inline();
    Session::put('captchaPhrase', $builder->getPhrase());
    return View::make('widgets.captcha',array(
        'captcha' => $captcha
    ));
});

?>