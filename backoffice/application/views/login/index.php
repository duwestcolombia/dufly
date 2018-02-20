<div class="row justify-content-center " style="margin-bottom: 55px;">
	<div class=" col-md-4 col-sm "></div>
</div>
<div class="container">
	<div class="row justify-content-center ">
		<div class=" col-md-4 col-sm ">

			<div class="card" >
			  	<div class="card-body">
			    	<h2 class="card-tittle">Ingreso al sistema</h2>
			    	<?php echo form_open('login/validaingreso'); ?>
				    <div class="form-group">
				    	<label for="usuario">Correo</label>
				    	<input type="email" class="form-control" name="txt_usu">
				    </div>
				    <div class="form-group">
				    	<label for="contrasena">Contraseña</label>
				    	<input type="password" class="form-control" name ="txt_pass">
				    </div>
						<button type="submit" class="btn btn-primary btn-lg btn-block">Ingresar</button>
					<?php echo form_close(); ?>
			  	</div>
			</div>


		</div>

	</div>
</div>
<?php if (isset($error)) { ?>

<div class="container">
	<div class="row justify-content-center ">
		<div class=" col-md-4 col-sm ">
			<div class="alert alert-warning" role="alert">
			  <h4 class="alert-heading">Tenemos problemas!</h4>
			  <p><?php echo $error ?></p>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/login.js') ?>"></script>
