<?php

class TxnLink extends \Eloquent {
	protected $fillable = [];

	protected $table = 'txn_links';

	public function user(){
		return $this->belongsTo('User');
	}
}