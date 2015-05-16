<?php

class Post extends Eloquent {

	protected $fillable = array('title', 'text');

	public static function boot(){
		parent::boot();

		self::creating(function($model){
			$model->key = Str::lower(Str::random(6));
		});
	}

	public function author(){
		return $this->belongsTo('User', 'user_id');
	}

	public static function latest(){
		return self::orderBy('created_at', 'desc')->limit(10)->get();
	}

	public function getRouteParamsAttribute(){
		return array(
			$this->author->username, 
			$this->key, 
			$this->slug);
	}

	public function getSlugAttribute(){
		return Str::slug($this->title);
	}

	public function getShortAttribute(){
		return route('post.short', array($this->key));
	}

	public function getUrlAttribute(){
		return route('post', $this->route_params);
	}

}