<script>
	window.onload = function() {
	    $('#example').DataTable({
	    	language: {
	    	        processing:     "Procesamiento en curso...",
	    	        search:         "Buscar en la tabla:",
	    	        lengthMenu:    "Mostrar _MENU_ elementos",
	    	        info:           "Mostrando  _START_ a _END_ de _TOTAL_ elementos encontrados",
	    	        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
	    	        infoPostFix:    "",
	    	        loadingRecords: "Cargando datos...",
	    	        zeroRecords:    "No se encontro ningun dato para mostrar.",
	    	        emptyTable:     "La tabla se encuentra vacia.",
	    	        paginate: {
	    	            first:      "Siguiente",
	    	            previous:   "Previo",
	    	            next:       "Siguiente",
	    	            last:       "Ultimo"
	    	        }
	    	    }
	    });

	}
</script>

<div class="row justify-content-center " style="margin-bottom: 55px;">
	<div class=" col-md-4 col-sm "></div>
</div>
<div class="container">
	<h1 class="page-header">
		Solicitudes Recientes
	</h1>
	<hr>
	
	<ol class="breadcrumb">
	  <li class="breadcrumb-item active" aria-current="page">Solicitudes</li>
	</ol>


	<div class="table-responsive">
	<table data-order='[[ 1, "desc" ]]' class="table table-striped table-bordered table-hover " id="example" cellspacing="0" width="100%">

		<thead>
			<tr>
				<th>Solicitud #</th>
				<th>Estado</th>
				<th>Fecha solicitud</th>
				<th>Solicitante</th>
				<th>Tercero</th>
				<th>Objetivo Solicitud</th>
				<th>Autorizado por</th>
				<th>Liberado por</th>
				<th>Observación</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($result as $r): ?>
				<?php if ($r->ESTADO_SOLICITUD == 'PENDIENTE' || $r->ESTADO_SOLICITUD == 'NUEVA'): ?>
					<?php switch ($r->ESTADO_SOLICITUD) {
				case 'NUEVA':
					echo '<tr class="table-primary">';
					break;
				case 'AUTORIZADA':
					echo '<tr class="table-success">';
					break;
				case 'PENDIENTE':
					echo '<tr class="table-warning">';
					break;
				case 'RECHAZADA':
					echo '<tr class="table-danger">';
					break;

				default:
					echo "<tr>";
					break;
			} ?>

				<td><?php echo $r->COD_SOLICITUD ?></td>
				<td>
					<?php
						if ($r->ESTADO_SOLICITUD == 'PENDIENTE') {
							echo $r->ESTADO_SOLICITUD." POR LIBERAR";
						} else {
							echo $r->ESTADO_SOLICITUD;
						}
						 
						 
					?>
				
				</td>
				<td><?php echo $r->FREG_SOLICITUD ?></td>
				<td><?php echo $r->NOMBRE_EMPLEADO ?></td>
				<td><?php echo $r->NOM_TERCERO ?></td>
				<td><?php echo $r->OBJETIVO_SOLICITUD ?></td>
				<td><?php echo $r->AUTORIZA_SOLICITUD ?></td>
				<td><?php echo $r->LIBERA_SOLICITUD ?></td>
				<td><?php echo $r->OBSERVACION_SOLICITUD ?></td>
				<td>
					<a href="<?php echo site_url('principal/visualizar/'. $r->COD_SOLICITUD); ?>" class="btn btn-light btn-sm" title="Ver mas"><i class="fas fa-eye"></i></a>
					<!--
					<?php //if ($r->ESTADO_SOLICITUD == 'RECHAZADA' || $r->ESTADO_SOLICITUD == 'NUEVA'): ?>
						<a href="" class="btn btn-light btn-sm disabled" title="Enviar"><i class="fas fa-share-square"></i></a>
					<?php //else: ?>
						<a href="" class="btn btn-light btn-sm" title="Enviar"><i class="fas fa-share-square"></i></a>
					<?php //endif ?>
				-->
				</td>
			</tr>
				<?php endif; ?>


			<?php endforeach ?>
		</tbody>
	</table>
	</div>
	<?php //echo $this->pagination->create_links(); ?>



</div>
