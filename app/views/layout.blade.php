<!DOCTYPE html>
<html lang="en">
<head>
	@yield('meta')
	<meta charset="UTF-8">
	<title>@yield('title')</title>
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
	<link rel="stylesheet" href="//getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css">
	<style type="text/css">
	body {
		background: whitesmoke;
	}
	h1 {
		font-size: 50px;
		letter-spacing: -0.0675em;
		line-height: 1;
		margin: 0 0 20px;
		font-weight: bold;
	}

	h1 a {
		color: black;
		text-decoration: none;
	}
	</style>
</head>
<body>
	<div class="container">
	<div class="header clearfix">
		<nav>
			<ul class="nav nav-pills pull-right">
				<li role="presentation" class="active"><a href="/">Inicio</a></li>
				@if(Auth::guest())
				<li role="presentation"><a href="/register">Registro</a></li>
				<li role="presentation"><a href="/login">Login</a></li>
				@else
				<li><a href="{{ Auth::user()->blog }}">{{ Auth::user()->display_name }}</a></li>
				<li><a href="/logout">Salir</a></li>
				@endif
			</ul>
		</nav>
		<h3 class="text-muted">Magiblog</h3>
	</div>
	
	@yield('outlet:before')
	@yield('outlet')
	@yield('outlet:after')
	
	<footer class="footer">
		<p class="text-center">
			Multi-million dollar blog SaaS &copy; 2015<br/>
			<img src="http://media.carbonated.tv/122629_story__church.jpg" class="img-rounded" style="height:25px;width:25px;">
		</p>
	</footer>

	</div>
	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
	@yield('hook:js')
</body>
</html>