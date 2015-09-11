<?php

class Category extends \Eloquent {
	protected $fillable = [];

    protected $table = 'categories';

    public function getLink(){
        return '/'.$this->alias.'.html';
    }
}