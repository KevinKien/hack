<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    public static 	$rules = array(
        'username'=>'required|min:4|max:45|alpha_num|unique:users',
        'password'=>'required|alpha_num|min:6|max:12|confirmed',
        'password_confirmation'=>'required|alpha_num|min:6|max:12'
    );

    public function roles() {
        return $this->belongsToMany('Role');
    }
    public function hasRole($key)
    {
        foreach ($this->roles as $role) {
            if ($role->role_name === $key) {
                return true;
            }
        }
        return false;
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }
}
