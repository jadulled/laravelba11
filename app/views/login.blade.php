@extends('layout')

@section('title'){{ 'Iniciar sesión' }} @stop

@section('outlet')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel">
				<div class="panel-body">
					<h1>Iniciar sesión</h1>
					{{ Form::open(array('url' => '/login')) }}
					@include('partials.alerts')
					<div class="form-group">
						<label for="email" class="form-label">E-mail</label>
						<div class="form-controls">
							{{ Form::email('email', Input::old('email'), array('tabindex' => 1, 'class' => 'form-control', 'required')) }}
						</div>
					</div>
					<div class="form-group">
						<label for="password" class="form-label">Contraseña</label>
						<div class="form-controls">
							{{ Form::password('password', array('tabindex' => 2, 'class' => 'form-control', 'required')) }}
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