@if(count($errors->all('<p>:message</p>')) != 0)
<div class="alert alert-warning" data-hide="hide">
	@foreach ($errors->all('<p>:message</p>') as $msg)
		{{ $msg }}
	@endforeach
</div>
@endif

@if(Session::get('msg'))
<div class="alert alert-success" data-hide="hide">
	<p>{{ Session::get('msg') }}</p>
</div>
@endif

@if(Session::get('notification'))
<div class="alert alert-info" data-hide="hide">
	<p>{{ Session::get('notification') }}</p>
</div>
@endif

@if(Session::get('error'))
<div class="alert alert-danger" data-hide="hide">
	<p>{{ Session::get('error') }}</p>
</div>
@endif