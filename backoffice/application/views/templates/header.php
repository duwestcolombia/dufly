<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $titulo ?> | Duwest Colombia</title>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,500,700" type="text/css">

	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/material.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/main.css">
	<!--<link rel="stylesheet" type="text/css" href="<?php //echo base_url();?>style/materialize/css/materialize.min.css" >-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/bootstrap/css/bootstrap.min.css">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>img/logo.png">
	
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->

	<!--TIMEPIKER -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/datetimepicker/bootstrap-datetimepicker.min.css">
	
	<!--END -->

	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

	<!-- <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css"> -->

	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-red.min.css" />

	<!--<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.teal-green.min.css" />-->

	<!--<script src="<?php //echo base_url();?>style/bootstrap/js/bootstrap.min.js"></script>-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<style>
		#btn_mas {
		  position: fixed;
		  display: block;
		  right: 0;
		  bottom: 0;
		  margin-right: 40px;
		  margin-bottom: 40px;
		  z-index: 900;
		}
	</style>
</head>
<body>

<div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
		  <header class="mdl-layout__header">
		    <div class="mdl-layout__header-row">
		      <!-- Title -->
		      <span class="mdl-layout-title">DuFly <i class="material-icons">flight_takeoff</i></span>
		      <!-- Add spacer, to align navigation to the right -->
		      <div class="mdl-layout-spacer"></div>
		      <!-- Navigation. We hide it in small screens. -->
		      <nav class="mdl-navigation mdl-layout--large-screen-only">
		      	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/reserva">Nueva reserva</a>
		      	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/login/cerrarsesion">Cerrar Sesion</a>
		      </nav>
		    </div>
		  </header>
		  <div class="mdl-layout__drawer">
		    
		    <span class="mdl-layout-title">Dyfly</span>

		    <nav class="mdl-navigation">
		    	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/principal">Inicio</a>
		    	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/reserva">Nueva reserva</a>
		    	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/repgastos">Reporte Gastos</a>
		    	    <a class="mdl-navigation__link" href="#" id="madm-resviaje">Resumen de viajes</a>
		    	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/misreservas" id="madm-reserva">Mis reservas</a>
		    	    <hr>
		    	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/dashboard"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i> Dashboard</a>
		    		<a href="<?php echo base_url();?>index.php/allreservas" class="mdl-navigation__link"><i class="mdl-color-text--blue-grey-400 material-icons">confirmation_number</i> Ver Reservas</a>
		    	    <hr>
		    	    <a class="mdl-navigation__link" href="<?php echo base_url();?>index.php/gestionbd">
		    	    	<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i> Gestion BD
		    	    </a>

		    	    <div class="mdl-navigation__link">
		    	    	<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">settings</i> Gestion BD
		    	    		<!-- Right aligned menu below button -->
		    	    		<button id="btn_option admin"
		    	    		        class="mdl-button mdl-js-button mdl-button--icon">
		    	    		  <i class="material-icons">more_vert</i>
		    	    		</button>

		    	    		<ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
		    	    		    for="btn_option admin">
		    	    		  <li class="mdl-menu__item">Some Action</li>
		    	    		  <li class="mdl-menu__item">Another Action</li>
		    	    		  <li disabled class="mdl-menu__item">Disabled Action</li>
		    	    		  <li class="mdl-menu__item">Yet Another Action</li>
		    	    		</ul>
		    	    </div>
		    </nav>
		  </div>
		<script>
			$(document).ready(function(){
				//$("#madm-reserva").hide();
				//$("#madm-resviaje").hide();
			});
		</script>
