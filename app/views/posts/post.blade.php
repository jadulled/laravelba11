@extends('layout')

@section('meta')
<meta name="test" value="test" />
@stop

@section('title'){{ $post->title }} @stop

@section('outlet')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
					@include('posts.partials.post', array('post' => $post, 'hide_author' => true))
				</div>
			</div>
		</div>
	</div>
</div>
@stop