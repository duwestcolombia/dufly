<div class="row justify-content-center " style="margin-bottom: 55px;">
	<div class=" col-md-4 col-sm "></div>
</div>

<div class="container">
	<h1 class="page-header">
		<?php echo 'Solicitud # '.$data->COD_SOLICITUD ?>
	</h1>
	<hr>
	<ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page">
			<a href="<?php echo site_url('principal'); ?> ">Solicitudes</a>
		</li>
	  	<li class="breadcrumb-item active" aria-current="page">	<?php echo 'Solicitud # '.$data->COD_SOLICITUD ?>
	  	</li>
	</ol>

	<div class="row">
		<div class="col-md-4">
			<?php echo form_open('principal/guardar'); ?>
			<div class="card" >

			  <div class="card-body">
			  	<h5 class="card-title">Pasajero</h5>
			  	<?php if ($data->DOC_TERCERO > 1): ?>
			  		<p class="card-text font-weight-light"><?php echo $data->NOM_TERCERO ?></p>
			  	<?php else: ?>
			  		<p class="card-text font-weight-light"><?php echo $data->NOMBRE_EMPLEADO ?></p>
			  	<?php endif ?>

			  	<?php if ($data->DOC_TERCERO > 1): ?>
			  		<h5 class="card-title">Num. documento</h5>
			  		<p class="card-text font-weight-light"><?php echo $data->TIPDOC_TERCERO .":". $data->DOC_TERCERO ?></p>
			  		<h5 class="card-title">Telefono </h5>
			  		<p class="card-text font-weight-light"><?php echo $data->TEL_TERCERO ?></p>
			  		<h5 class="card-title">Fecha de nacimiento </h5>
			  		<p class="card-text font-weight-light"><?php echo $data->FNACIMIENTO_TERCERO ?></p>
			  	<?php else: ?>
			  		<h5 class="card-title">Telefono </h5>
			  		<p class="card-text font-weight-light"><?php echo $data->TEL_EMPLEADO ?></p>
			  		<h5 class="card-title">Fecha de nacimiento </h5>
			  		<p class="card-text font-weight-light"><?php echo $data->FNACIMIENTO_EMPLEADO ?></p>
			  	<?php endif ?>
			  		<h5 class="card-title">Estado</h5>
						<?php switch ($data->ESTADO_SOLICITUD) {
							case 'RECHAZADA':
								echo '<p class="card-text font-weight-light"><span class="badge badge-danger"> '.$data->ESTADO_SOLICITUD.' </span></p>';
								break;
							case 'AUTORIZADA':
								echo '<p class="card-text font-weight-light"><span class="badge badge-success"> '.$data->ESTADO_SOLICITUD.' </span></p>';
								break;

							default:
								echo '<p class="card-text font-weight-light"><span class="badge badge-primary"> '.$data->ESTADO_SOLICITUD.' </span></p>';
								break;
						} ?>


			    	<h5 class="card-title"> Registrar Observación</h5>
			    	<input type="hidden" name="txt_codsolicitud" value="<?php echo $data->COD_SOLICITUD ?>">
			    	<textarea name="txt_observacion" cols="30" rows="3" class="form-control" maxlength="300"><?php echo $data->OBSERVACION_SOLICITUD ?></textarea>

			    	<hr>

			  </div>
			  <div class="card-footer">
				<!-- <div class="btn-group" role="group" >-->
					<button class="btn btn-sm btn-primary" type="submit">Guardar</button>
					<?php if ($data->ESTADO_SOLICITUD == 'RECHAZADA'): ?>
						<a href="<?php echo site_url('principal/autorizar/'. $data->COD_SOLICITUD); ?>" class="btn btn-sm btn-success disabled">Autorizar</a>
					<?php else: ?>
						<a href="<?php echo site_url('principal/autorizar/'. $data->COD_SOLICITUD); ?>" class="btn btn-sm btn-success">Autorizar</a>
					<?php endif ?>


				  	<a href="<?php echo site_url('principal/rechazar/'. $data->COD_SOLICITUD); ?>" class="btn btn-sm btn-danger">Rechazar</a>
				  	<a href="<?php echo site_url('principal'); ?>" class="btn btn-sm btn-secondary">Regresar</a>
				<!--</div>-->
			  </div>
			</div>
			<?php echo form_close(); ?>
		</div>
		<div class="col-md-8">
			<div class="card" style="margin-bottom: 8px;">
				<div class="card-header">
					Vuelos <i class="fas fa-plane"></i>
				</div>
				<div class="card-body">

					<ul class="list-group">
						<?php foreach ($data->Vuelos as $dv): ?>
							<li class="list-group-item">
								<?php echo '<b>Origen</b>: ' . $dv->CIUD_ORIGEN. ' - <b>Destino</b>: ' . $dv->CIUD_DESTINO ?>
								<span class="float-right">
									<?php echo '<b>Fecha salida</b>: '.$dv->FIDA_RESERVA ?>
								</span>
								<?php if ($dv->FREGRESO_RESERVA>0): ?>
									<br>
									<span class="float-right">
									<?php echo '<b>Fecha regreso</b>: '.$dv->FREGRESO_RESERVA ?>
									</span>
								<?php endif ?>

							</li>
						<?php endforeach ?>


					</ul>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					Hoteles <i class="fas fa-h-square"></i>
				</div>
				<div class="card-body">

					<ul class="list-group">
						<?php foreach ($data->Hoteles as $dh): ?>
							<li class="list-group-item">
								<?php echo '<b>Ciudad</b>: ' . $dh->CIUD_HOTEL ?>
								<span class="float-right">
									<?php echo '<b>Fecha Ingreso</b>: '.$dh->FINHOTEL_RESERVA ?>
								</span>
								<br>
								<span class="float-right">
									<?php echo '<b>Fecha Salida</b>: '.$dh->FSALHOTEL_RESERVA ?>
								</span>

							</li>
						<?php endforeach ?>


					</ul>
				</div>

			</div>

		</div>
	</div>

</div>
