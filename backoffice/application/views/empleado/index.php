<div class="row justify-content-center " style="margin-bottom: 55px;">
	<div class=" col-md-4 col-sm "></div>
</div>

<div class="container">
	<h1 class="page-header">
		<?php echo 'Perfil del empleado '.$data->NOMBRE_EMPLEADO ?>
	</h1>
	<hr>
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page">
			<a href="<?php echo site_url('empleado'); ?> ">Empleados</a>
		</li>
	  	<li class="breadcrumb-item active" aria-current="page">	<?php echo $data->NOMBRE_EMPLEADO ?>
	  	</li>
	</ol>



	<div class="row">
		<div class="col-md-4">
			<?php echo form_open('empleado/actualizar'); ?>
			<div class="card" >

			  <div class="card-body">
						<h5 class="card-title">Codigo empleado</h5>
			  		<p class="card-text font-weight-light"><?php echo $data->COD_EMPLEADO ?></p>
						<h5 class="card-title">Correo</h5>
					  <p class="card-text font-weight-light"><?php echo $data->EMAIL_EMPLEADO ?></p>
					  <input type="text" name="txt_email" hidden value="<?php echo $data->EMAIL_EMPLEADO ?>">
						<h5 class="card-title">Nombres</h5>
			  		<input type="text" name="txt_nomempleado" class="form-control" value="<?php echo $data->NOMBRE_EMPLEADO ?>">
						<h5 class="card-title">Teléfono/Celular </h5>
						<input type="number" name="txt_telefono" class="form-control" value="<?php echo $data->TEL_EMPLEADO ?>">

			  		<h5 class="card-title">Fecha de nacimiento</h5>
						<input type="date" name="txt_fnacimiento" class="form-control" name="" value="<?php echo $data->FNACIMIENTO_EMPLEADO ?>">




			  </div>
			  <div class="card-footer">

			  </div>
			</div>

		</div>
		<div class="col-md-8">
			<div class="card" style="margin-bottom: 8px;">
				<div class="card-header">
					Modificar Contraseña <i class="fas fa-key"></i>
				</div>
				<div class="card-body">
					<h5>Ingrese un nueva contraseña</h5>
					<input type="password" name="txt_pass" class="form-control" value="">
					<h5>Confirme la contraseña ingresada</h5>
					<input type="password" name="txt_passConfig" class="form-control" value="">

				</div>
			</div>

			<!--<div class="card">
				<div class="card-header">
					Hoteles <i class="fas fa-h-square"></i>
				</div>
				<div class="card-body">




					</ul>
				</div>

			</div>-->

		</div>
	</div>

	<ol class="breadcrumb">
		<li class="breadcrumb-item">
						<button class="btn btn-sm btn-primary"><i class="fas fa-check-circle"></i> Actualizar
						</button>

				  	<a href="<?php echo site_url('principal'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-angle-double-left"></i> Regresar</a>
		</li>
	</ol>
	<?php echo form_close(); ?>

</div>

<script type="text/javascript" href="<?php echo base_url('assets/js/').'empleado.js'; ?>"></script>
