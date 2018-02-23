<script>
	window.onload = function() {
	    var table = $('#example').DataTable({
	    	language: {
	    	        processing:     "Procesamiento en curso...",
	    	        search:         "Buscar en la tabla:",
	    	        lengthMenu:    "Mostrar _MENU_ elementos",
	    	        info:           "Mostrando  _START_ a _END_ de _TOTAL_ elementos encontrados",
	    	        infoFiltered:   "(filtrado entre _MAX_ elementos totales)",
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
	    	    },
						buttons: [
							{
								extend:'colvis',
								text:'Columnas a mostrar'
							},
							{
								extend:'copy',
								text:'<i class="fas fa-copy"></i> Copiar'
							},
							{
								extend:'excel',
								text:'<i class="fas fa-file-excel"></i> Excel'
							},
							{
								extend:'pdf',
								text:'<i class="fas fa-file-pdf"></i> PDF'
							},
							{
								extend:'print',
								text:'<i class="fas fa-print"></i> Imprimir'
							}

						]
	    });
			table.buttons().container()
        .appendTo( '#example_wrapper  .col-md-6:eq(0)' );
	}
</script>

<div class="row justify-content-center " style="margin-bottom: 55px;">
	<div class=" col-md-4 col-sm "></div>
</div>
<div class="container">
	<h1 class="page-header">
		Todas las solicitudes
	</h1>
	<hr>
  <ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page">
			<a href="<?php echo site_url('principal'); ?> ">Solicitudes</a>
		</li>
	  	<li class="breadcrumb-item active" aria-current="page">	Todas
	  	</li>
	</ol>


	<div class="table-responsive">
	<table data-order='[[ 0, "desc" ]]' class="table table-striped table-bordered table-hover" id="example" cellspacing="0" width="100%">

		<thead>
			<tr>
				<th>Solicitud #</th>
				<th>Estado</th>
				<th>Fecha</th>
				<th>Solicitante</th>
				<th>Tercero</th>
				<th>Objetivo Solicitud</th>
				<th>Autoriza o Rechaza</th>
				<th>Liberado por</th>
				<th>Observación</th>
				<th>Acción</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($result as $r): ?>
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
				<td><?php echo $r->ESTADO_SOLICITUD ?></td>
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
			<?php endforeach ?>
		</tbody>
	</table>
	</div>
	<?php //echo $this->pagination->create_links(); ?>



</div>
