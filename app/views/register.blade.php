@extends('layout')

@section('title'){{ 'Registro' }} @stop

@section('outlet')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel">
				<div class="panel-body">
					<h1>Registro</h1>
					{{ Form::open(array('url' => '/register')) }}
					@include('partials.alerts')
					<div class="form-group">
						<label for="username" class="form-label">Usuario</label>
						<div class="form-controls">
							{{ Form::text('username', Input::old('username'), array('tabindex' => 1, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="name" class="form-label">Nombre</label>
						<div class="form-controls">
							{{ Form::text('name', Input::old('name'), array('tabindex' => 2, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="last_name" class="form-label">Apellido</label>
						<div class="form-controls">
							{{ Form::text('last_name', Input::old('last_name'), array('tabindex' => 3, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="form-label">E-mail</label>
						<div class="form-controls">
							{{ Form::email('email', Input::old('email'), array('tabindex' => 4, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="form-label">Contraseña</label>
						<div class="form-controls">
							{{ Form::password('password', array('tabindex' => 5, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<div class="form-controls">
							{{ Form::button('Continuar', array('class' => 'btn btn-lg btn-primary', 'tabindex' => 6, 'type' => 'submit')) }}
						</div>
					</div>
					{{ Form::close() }}
				</div>
			</div>
		</div>
	</div>
</div>
@stop