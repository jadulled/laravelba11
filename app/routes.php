<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('prefix' => '/test', 'as' => 'test'), function(){
	Route::post('/', function(){
		return Input::get('param');
	});
});

Route::when('*', 'csrf', array('post','put','patch','delete'));

Route::get('/', function(){
	return View::make('index')->with('posts', Post::latest());
});

Route::group(array('before' => 'guest'), function(){

	Route::group(array('prefix' => '/login'), function(){
		Route::get('/', function(){
			return View::make('login');
		});

		Route::post('/', function(){
			$input = Input::all();

			$validation = Validator::make($input, array(
				'email' => 'required|email',
				'password' => 'required'
				));

			if($validation->fails())
				return Redirect::to('/login')->withInput()->withErrors($validation);

			if( ! Auth::attempt(array(
				'email' => $input['email'],
				'password' => $input['password']
				)))
				return Redirect::to('/login')->with('error', 'Combinación incorrecta.');

			$user = Auth::user();

			return Redirect::route('blog', array($user->username))->with('msg', 'Hola ' . $user->name . '!');
		});
	});

	Route::group(array('prefix' => '/register'), function(){
		Route::get('/', function(){
			return View::make('register');
		});

		Route::post('/', function(){
			$input = Input::all();
			$validation = Validator::make($input, array(
				'username' => 'required|unique:users',
				'email' => 'required|email|unique:users',
				'password' => 'required|min:5',
				'name' => 'required',
				'last_name' => 'required'
				));

			if($validation->fails())
				return Redirect::to('/register')->withInput()->withErrors($validation);

			$user = User::create(array(
				'username' => $input['username'],
				'email' => $input['email'],
				'password' => $input['password'],
				'name' => $input['name'],
				'last_name' => $input['last_name'],
				));

			Auth::loginUsingId($user->id);

			return Redirect::route('blog', array($user->username))->with('msg', 'Bienvenido a tu nuevo blog.');
		});
	});

});

Route::get('/p/{postId}', array('before' => 'post_exists', 'uses' => 'Blogs@redirect', 'as' => 'post.short'));

//Route::group(array('prefix' => 'blogs'), function(){

	Route::group(array('prefix' => '@{username}', 'before' => 'blog_exists'), function(){
		Route::get('/', array('uses' => 'Blogs@index', 'as' => 'blog'));

		Route::group(array('prefix' => '/publish', 'as' => 'post.create', 'before' => 'auth|blog_auth'), function(){
			Route::get('/', function(){
				return View::make('posts.create')->with('user', Auth::user());
			});

			Route::post('/', function(){
				$input = Input::all();
				$validation = Validator::make($input, array(
					'title' => 'required',
					'text' => 'required',
					));

				if($validation->fails())
					return Redirect::back()->withInput()->withErrors($validation);

				$user = Auth::user();
				$post = $user->posts()->create(array(
					'title' => $input['title'],
					'text' => $input['text']
					));

				return Redirect::route('post', array_merge($post->route_params, array('paramnuevo')))->with('msg', 'Post publicado');
			});
		});

		Route::group(array('prefix' => '/post/{postId}-{slug}', 'before' => 'post_exists'), function(){
			Route::get('/', array('as' => 'post', 'uses' => 'Blogs@post'));

			Route::group(array('before' => 'auth|blog_auth'), function(){
				Route::group(array('prefix' => '/edit', 'as' => 'post.edit'), function(){
					Route::get('/', 'Blogs@edit');
					Route::patch('/', 'Blogs@update');
				});

				Route::delete('/', array('uses' => 'Blogs@delete', 'as' => 'post.delete'));
			});
		});
	});

//});

Route::group(array('before' => 'auth'), function(){
	Route::get('/logout', function(){
		Auth::logout();
		return Redirect::to('/login')->with('msg', 'Cerraste sesión');
	});
});