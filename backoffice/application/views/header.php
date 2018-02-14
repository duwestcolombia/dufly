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
</head>
<body>

<?php if (isset($user)): ?>
	

	<nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
	  <a class="navbar-brand" href="#">DuFly</a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav">
	      <li class="nav-item active">
	        <a class="nav-link" href="#">Inicio <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item">
	        <a class="nav-link" href="#">Solicitudes</a>
	      </li>
	      
	    </ul>
	  </div>
	</nav>
<?php endif ?>