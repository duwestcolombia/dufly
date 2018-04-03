<div class="container">
  <h1 class="page-header">
    Respuesta de la solicitud
  </h1>
  <hr>
  <ol class="breadcrumb">
		<li class="breadcrumb-item" aria-current="page">
			<a href="<?php echo site_url('principal'); ?> ">Solicitudes</a>
		</li>
	  	<li class="breadcrumb-item active" aria-current="page">	Mensaje
	  	</li>
	</ol>
  <div class="alert alert-primary" role="alert">
    <?php if (!empty($message)): ?>
  		<?php echo $message; ?>
  	<?php endif; ?>
  </div>
  <a href="<?php echo site_url('principal'); ?>" class="btn btn-dark">Regresar</a>

</div>
