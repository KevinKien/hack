<?php

class Txn extends \Eloquent {
	protected $fillable = [];

    protected $table = 'txns';

    public function user(){
        return $this->belongsTo('User');
    }

    public function getResponsemsgAttribute(){
        return Config::get('common.txn_card_responses.'.$this->attributes['response_code']);
    }
}