<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	protected $fillable = array('username', 
		'name', 'last_name', 'email', 'password');
	protected $hidden = array('password', 'remember_token');

	public static function boot(){
		parent::boot();

		self::creating(function($model){
			$model->password = Hash::make($model->password);
		});
	}

	public function getDisplayNameAttribute(){
		return $this->name . ' ' . $this->last_name;
	}

	public function posts(){
		return $this->hasMany('Post');
	}

	public function getBlogAttribute(){
		return route('blog', array($this->username));
	}

}