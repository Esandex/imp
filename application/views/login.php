<!DOCTYPE html>
<html>
<head>
	<title>Importaciones Makeup Peru</title>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width = device-width, initial-scale=1, maximum-scale=1"/>
	<!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="template/css/materialize.min.css"  media="screen,projection"/>
    <!-- Otros CSS -->
	<link rel="stylesheet" type="text/css" href="template/css/main.css">
</head>
<body>
	<header>
		<nav>
		    <div class="container nav-wrapper ">
		      <a href="<?= base_url() ?>" class="brand-logo">IMP</a>
		    </div>
		</nav>
	</header>	
	<section class="container">
		<div class="row center">
			<h2>Iniciar Sesión</h2>
		</div>
		<div class="row">
			<form class="col s12" action="login/validar" method="post">
				<div class="row">
					<div class="input-field col s12">
						<input id="username" name="username" type="text" />
						<label for="username">Username</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input id="password" name="password" type="password" />
						<label for="password">Password</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s12">
						<input class="btn-large col s12" type="submit" value="Ingresar" />		
					</div>
				</div>
			</form>
		</div>
	</section>
	<!--Import jQuery before materialize.js-->
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="template/js/materialize.min.js"></script>
    <!-- Otros JS -->
	<script type="text/javascript" src="template/js/main.js"></script>
</body>
</html>