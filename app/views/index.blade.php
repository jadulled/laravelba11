@extends('layout')

@section('title'){{ 'Últimos posts' }} @stop

@section('outlet')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			@foreach($posts as $post)
			<div class="panel">
				<div class="panel-body">
					@include('posts.partials.post', array('post' => $post))
				</div>
			</div>
			@endforeach
		</div>
	</div>
</div>
@stop