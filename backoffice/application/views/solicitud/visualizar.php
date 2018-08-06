<div class="row justify-content-center " style="margin-bottom: 55px;">
	<div class=" col-md-4 col-sm "></div>
</div>

<div class="container">
	<h1 class="page-header">
		<?php echo 'Solicitud # '.$data->COD_SOLICITUD; ?>
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
								case 'PENDIENTE':
									echo '<p class="card-text font-weight-light"><span class="badge badge-warning"> '.$data->ESTADO_SOLICITUD.' </span></p>';
									break;
							case 'AUTORIZADA':
								echo '<p class="card-text font-weight-light"><span class="badge badge-success"> '.$data->ESTADO_SOLICITUD.' </span></p>';
								break;

							default:
								echo '<p class="card-text font-weight-light"><span class="badge badge-primary"> '.$data->ESTADO_SOLICITUD.' </span></p>';
								break;
						} ?>

						<?php if ($data->AUTORIZA_SOLICITUD != ''): ?>
							<h5 class="card-title">Autorizado/Rechazado por </h5>
							<p class="card-text font-weight-light"><?php echo $data->AUTORIZA_SOLICITUD ?></p>
							<h5 class="card-title">Fecha de Autorización o Rechazo </h5>
							<p class="card-text font-weight-light"><?php echo $data->FAUTORIZA_SOLICITUD ?></p>

						<?php endif; ?>
						<?php if ($data->LIBERA_SOLICITUD != null): ?>
							<h5 class="card-title">Liberado por </h5>
							<p class="card-text font-weight-light"><?php echo $data->LIBERA_SOLICITUD ?></p>
							<h5 class="card-title">Fecha de liberación </h5>
							<p class="card-text font-weight-light"><?php echo $data->FLIBERA_SOLICITUD ?></p>
						<?php endif; ?>
						<?php if ($user->COD_DEPARTAMENTO == '2' || $user->COD_DEPARTAMENTO == '3'): ?>
							<h5 class="card-title"> Registrar Observación</h5>

							<input type="hidden" name="txt_codsolicitud" value="<?php echo $data->COD_SOLICITUD ?>">
				    	<textarea name="txt_observacion" cols="30" rows="3" class="form-control" maxlength="300"><?php echo $data->OBSERVACION_SOLICITUD ?></textarea>
						<?php endif; ?>


			  </div>
			  <div class="card-footer">

			  </div>
			</div>

		</div>
		<div class="col-md-8">
			<div class="card" style="margin-bottom: 8px;">
				<div class="card-header">Objetivo de la solicitud</div>
				<div class="card-body">
					<b><?php echo $data->OBJETIVO_SOLICITUD ?></b>
				</div>
			</div>
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
								<br>
								<span class="float-right">
									<?php echo '<b>Tipo Habitación</b>: '.$dh->TIPOHAB_RESERVA ?>
								</span>

							</li>
						<?php endforeach ?>


					</ul>
				</div>

			</div>

		</div>
	</div>

	<ol class="breadcrumb">
		<li class="breadcrumb-item">
						<?php if ($data->ESTADO_SOLICITUD == 'RECHAZADA' || $data->ESTADO_SOLICITUD == 'AUTORIZADA' || $data->ESTADO_SOLICITUD == 'LIBERADA' || $data->ESTADO_SOLICITUD == 'PENDIENTE' || $data->COD_EMPLEADO == $user->COD_EMPLEADO): ?>

						<?php else: ?>
						<a href="<?php echo site_url('principal/autorizar/'. $data->COD_SOLICITUD); ?>" class="btn btn-sm btn-success"><i class="fas fa-check-circle"></i> Autorizar</a>
					<?php endif ?>

						<?php if ($user->COD_DEPARTAMENTO == '2' || $user->COD_DEPARTAMENTO == '3' ): ?>
								<?php if ($data->AUTORIZA_SOLICITUD != ''): ?>
									<button class="btn btn-sm btn-primary" type="submit"><i class="fas fa-save"></i> Actualizar solicitud</button>
									<a href="<?php echo site_url('principal/liberar/'. $data->COD_SOLICITUD); ?>" class="btn btn-sm btn-warning"><i class="fas fa-paper-plane"></i> Liberar y Enviar</a>
								<?php endif; ?>
						<?php endif; ?>


						<?php if ($data->ESTADO_SOLICITUD == 'RECHAZADA' || $data->ESTADO_SOLICITUD == 'AUTORIZADA' || $data->ESTADO_SOLICITUD == 'LIBERADA'): ?>

						<?php else: ?>
								<a href="<?php echo site_url('principal/rechazar/'. $data->COD_SOLICITUD); ?>" class="btn btn-sm btn-danger"><i class="fas fa-times-circle"></i> Rechazar</a>
						<?php endif; ?>

				  	<a href="<?php echo site_url('principal'); ?>" class="btn btn-sm btn-secondary"><i class="fas fa-angle-double-left"></i> Regresar</a>
		</li>
	</ol>
	<?php echo form_close(); ?>

</div>
