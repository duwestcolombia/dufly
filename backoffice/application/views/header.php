<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>DuFly | Duwest Colombia</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>assets/img/logo.png">
	<!--<link rel="stylesheet" href="<?php //echo base_url('assets/css/bootstrap.min.css');?>">-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<!--<link rel="stylesheet" href="https://cdn.datatables.net/fixedcolumns/3.2.4/css/fixedColumns.bootstrap4.min.css">-->

	<script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>

	<!-- DATATABLES -->


	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">

	<!-- -->

</head>
<body>

<?php if (isset($user)): ?>

<div class="">
	<!--<div class="fixed-top">-->
	<nav class="navbar navbar-expand-lg navbar-light bg-light">

	  	<a href="" class="navbar-brand">
				<img src="<?php echo base_url('assets/img/logo.png'); ?> " width="30" height="30" alt="">
				DuFly
			</a>
	  	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	    	<span class="navbar-toggler-icon"></span>
	  	</button>

	  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		    <ul class="navbar-nav mr-auto">
					<li class="nav-item  ">
						<a href="<?php echo site_url('principal/index') ?> " class="nav-link">Solicitudes recientes</a>
					</li>
					<?php if ($user->ROOT_EMPLEADO == '1' || $user->COD_DEPARTAMENTO == '2'): ?>
						<li class="nav-item">
							<a href="<?php echo site_url('principal/todas') ?> " class="nav-link">Todas las solicitudes</a>
						</li>
					<?php endif; ?>
					<?php if ($user->ROOT_EMPLEADO == '1'): ?>
						<li class="nav-item dropdown">
						  <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						   Administrar
						  </a>

							<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						    <a class="dropdown-item" href="#"> Paises</a>
								<a class="dropdown-item" href="#"> Ciudades</a>
								<a class="dropdown-item" href="#"> Empleados</a>
					  	</div>
					</li>
				<?php endif; ?>
		    </ul>


			<ul class="navbar-nav ">
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				   <i class="fas fa-user-circle"></i> <?php echo $user->NOMBRE_EMPLEADO ?>
				  </a>
				  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="<?php echo site_url('empleado'); ?>"><i class="fas fa-user"></i> Mi perfil</a>
						<a class="dropdown-item" href="<?php echo site_url('login/cerrarsesion'); ?>"> <i class="fas fa-sign-out-alt"></i> Desconectarme</a>

				  </div>
				</li>
			</ul>

	  </div>
	</nav>
</div>
<?php endif ?>
