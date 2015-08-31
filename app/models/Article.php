<?php

class Article extends \Eloquent {
	protected $fillable = [];

    protected $table = 'articles';

    public function categories()
    {
        return $this->belongsToMany('Category', 'article_category', 'article_id');
    }

    public function links(){
        return $this->hasMany('Link', 'article_id');
    }

    public function getUrl($categorySlug){
        return '/'.$categorySlug.'/'.$this->slug.'-'.$this->id.'.html';
    }

    public function getUrlWithMainCate(){
        $mainCategory = $this->getMainCate();
        return '/'.$mainCategory->alias.'/'.$this->slug.'-'.$this->id.'.html';
    }

    public function getMainCate(){
        $mainCategoryId = ArticleCategory::where('article_id', $this->id)->first();
        if(!$mainCategoryId) return;
        $mainCategory = Category::find($mainCategoryId->category_id);
        if(!$mainCategory) return;
        return $mainCategory;
    }
}