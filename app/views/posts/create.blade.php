@extends('layout')

@section('title'){{ 'Publica un pst' }} @stop

@section('outlet')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
					<h1>Publica un post</h1>
					{{ Form::open(array('route' => array('post.create', $user->username))) }}
					@include('partials.alerts')
					<div class="form-group">
						<label for="title" class="form-label">Título</label>
						<div class="form-controls">
							{{ Form::text('title', Input::old('title'), array('tabindex' => 1, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="text" class="form-label">Texto</label>
						<div class="form-controls">
							{{ Form::textarea('text', Input::old('text'), array('tabindex' => 2, 'class' => 'form-control', 'required', 'rows' => 5)) }}
						</div>
					</div>
					<div class="form-group">
						<div class="form-controls">
							{{ Form::button('Continuar', array('class' => 'btn btn-lg btn-primary', 'tabindex' => 3, 'type' => 'submit')) }}
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop