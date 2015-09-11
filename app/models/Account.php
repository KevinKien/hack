<?php

class Account extends \Eloquent {
	protected $fillable = array('user_id');

    protected $table = 'accounts';

    protected $softDelete = true;

	public function user(){
		return $this->belongsTo('User');
	}
}