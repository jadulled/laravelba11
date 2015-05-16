@extends('layout')

@section('title'){{ 'Blog de ' . $user->name }} @stop

@section('outlet')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			@if(Auth::check() && Auth::user()->id === $user->id)
			<div class="text-center">
				{{ link_to_route('post.create', 'Publica un nuevo post', array($user->username), array('class' => 'btn btn-primary')) }}
				<hr/>
			</div>
			@endif
			@include('partials.alerts')
			@forelse($posts as $post)
				@include('posts.partials.post', array('post' => $post, 'hide_author' => true))
			@empty
			<div class="alert alert-info">
				No hay posts aquí.
			</div>
			@endforelse
		</div>
	</div>
</div>
@stop