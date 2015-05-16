<?php

class Blogs extends Controller {

	public function __construct(){
		if(in_array(Route::currentRouteName(), array(
			'blog',
			'post',
			'post.edit',
			'post.delete',
			'post.create'
			)))
			if( ! $this->user = User::where('username', Route::current()->getParameter('username'))->first())
				App::abort(404);

		if(in_array(Route::currentRouteName(), array(
			'post',
			'post.edit',
			'post.delete',
			'post.create'
			)))
			if( ! $this->post = $this->user->posts()->where('key', Route::current()->getParameter('postId'))->first())
				App::abort(404);
	}

	public function index(){
		return View::make('blog')
					->with('user', $this->user)
					->with('posts', $this->user
										->posts()
										->orderBy('created_at', 'desc')
										->get());
	}

	public function post(){
		return View::make('posts.post')->with('post', $this->post);
	}

	public function edit(){
		return View::make('posts.edit')->with('post', $this->post);
	}

	public function update(){
		$input = Input::all();
		$validation = Validator::make($input, array(
			'title' => 'required',
			'text' => 'required',
			));

		if($validation->fails())
			return Redirect::back()->withInput()->withErrors($validation);

		$this->post->update(array(
			'title' => $input['title'],
			'text' => $input['text']
			));

		return Redirect::route('post.edit', $this->post->route_params)->with('msg', 'Post actualizado');
	}

	public function delete(){
		$authorUrl = $this->post->author->blog;
		$this->post->delete();
		return Redirect::to($authorUrl)
		->with('msg', 'Post eliminado');
	}

	public function redirect($postId){
		$post = Post::where('key', $postId)->first();
		return Redirect::route('post', $post->route_params);
	}

}