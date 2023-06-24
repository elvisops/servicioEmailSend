<nav class="navbar navbar-expand-lg navbar-light bg-barraNavegacion">
	<a class="navbar-brand" id="link" href="./correos.php" onclick="setActive(this)">Emailsend</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link text-dark" id="link" href="./historicoCampañas.php?id=<?php echo $usuarioId; ?>" onclick="setActive(this)">Campañas <span class="sr-only">(current)</span></a>
			</li>
		</ul>
		<span class="navbar-text">
			<li class="nav-item dropdown" style="list-style:none;">
				<a class="nav-link dropdown-toggle" style="margin-right:25px; text-decoration:none;" id="link" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
					<?php echo $_SESSION['campoNombre'] ?>
				</a>
				<div class="dropdown-menu">
					<a class="dropdown-item" href="./perfil.php?id=<?php echo $usuarioId; ?>" onclick="setActive(this)">Perfil</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" name="logout" id="logout" href="#">Salir <i class="fa fa-sign-out" aria-hidden="true"></i></a>
				</div>
			</li>
		</span>
	</div>
</nav>