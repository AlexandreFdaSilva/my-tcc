<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>@yield('title')</title>


	<!-- Fonte do google -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

	<!-- CSS bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

	<!-- CSS da aplicação -->

	<link rel="stylesheet" href="/css/styles.css">
	<script src="/js/scripts.js"></script>
</head>

<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-light">
			<div class="collapse navbar-collapse" id="navbar">
				<a href="/" class="navbar-brand">
					<img src="/img/logo.png" alt="UniNPs">
				</a>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a href="/moleculas/lista" class="nav-link">Moléculas</a>
					</li>
					<li class="nav-item">
						<a href="/moleculas/inserir" class="nav-link">Cadastrar Molécula</a>
					</li>
					<li class="nav-item">
						<a href="/plantas/lista" class="nav-link">Plantas</a>
					</li>
					<li class="nav-item">
						<a href="/referencias/lista" class="nav-link">Referências</a>
					</li>
					<li class="nav-item">
						<a href="/" class="nav-link">Entrar</a>
					</li>
				</ul>
			</div>
		</nav>

	</header>
	@yield('content')
	<footer>
		<p>UniNPs &copy; 2023</P>
	</footer>
	<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>