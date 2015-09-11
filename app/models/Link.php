<?php

class Link extends \Eloquent {
	protected $fillable = [];

    protected $table = 'links';

    public function isBuyByUser(){
        if(!Auth::user())
            return false;

        $txnLink = TxnLink::where('link_id', $this->id)
            ->where('user_id', Auth::user()->id)
            ->first();
        return $txnLink ? true : false;
    }
}