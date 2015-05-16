<h1><a href="{{ $post->url }}">{{ $post->title }}</a></h1>
@if(Auth::check() && Auth::user()->id === $post->user_id)
	{{ link_to_route('post.edit', 'Modificar post', $post->route_params) }}
@endif
<p>
	{{ $post->text }}
</p>
<ul>
	<li>Fecha: {{ $post->created_at->diffForHumans() }}</li>
	@if( ! isset($hide_author))
	<li>Autor: <a href="{{ $post->author->blog }}">{{ $post->author->display_name }}</a></li>
	@endif
</ul>