@extends('layout')

@section('title'){{ $post->title }} @stop

@section('outlet')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
					<h1>{{ $post->title }}</h1>
					{{ Form::open(array('route' => array('post.edit', $post->author->username, $post->key, $post->slug), 'method' => 'patch')) }}
					@include('partials.alerts')
					<div class="form-group">
						<label for="title" class="form-label">Título</label>
						<div class="form-controls">
							{{ Form::text('title', $post->title, array('tabindex' => 1, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="text" class="form-label">Texto</label>
						<div class="form-controls">
							{{ Form::textarea('text', $post->text, array('tabindex' => 2, 'class' => 'form-control', 'required', 'rows' => 5)) }}
						</div>
					</div>
					<div class="form-group">
						<div class="form-controls">
							{{ Form::button('Guardar', array('class' => 'btn btn-lg btn-primary', 'tabindex' => 3, 'type' => 'submit')) }}
							<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Eliminar post</button>
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>

{{ Form::open(array('route' => array('post.delete', $post->author->username, $post->key, $post->slug), 'method' => 'delete', 'class' => 'modal', 'id' => 'deleteModal')) }}
<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-body">
			<div class="alert alert-danger">
				Seguro?
			</div>
			{{ Form::button('Muy seguro', array('type' => 'submit', 'class' => 'btn btn-danger')) }}
		</div>
	</div>
</div>
{{ Form::close() }}
@stop