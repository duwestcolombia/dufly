
<main class="mdl-layout__content">

    <div class="page-content ">
    	<form action="<?php echo base_url(); ?>index.php/reserva/insertar" method="POST">
		<div class="mdl-grid">
			<div class="mdl-cell mdl-cell--8-col mdl-cell--6-col-tablet">
				
				<div id="dataVuelo"><!-- CARD FLY -->
				    <div class="demo-card-square mdl-card mdl-shadow--2dp">
				    	<div class="mdl-card__title mdl-card--expand" id="titulo_vuelo">
				    		  	<h2 class="mdl-card__title-text">Información del Vuelo</h2>
				    	</div>
				    	<div class="mdl-card__supporting-text">
				    		<div class="row" id="fila-vuelo1" onclick="picker(this.id)">
				    			<div class="col-md-4 col-xs-6 col-sm-4">
					    			<label for="lblOrigen">Origen</label>
					    			<select class="form-control" name="txt_origen[]" id="txt_origen" >
					    				<option value="" disabled selected>Seleccione la ciudad de origen</option>
					    					<?php foreach ($lst_paisCiudad as $ciudad) {?>
					    				<option value="<?php echo $ciudad->ID_CIUDAD ?>"><?php echo $ciudad->CIUDAD ?></option>
					    					<?php } ?>
					    					    
					    			</select>		    					
					    					
				    			</div>
				    			<div class="col-md-4 col-xs-6 col-sm-4">
					    			<label for="lblDestino">Destino</label>
					    			<select class="form-control" name="txt_destino[]" id="txt_destino" >
					    					  <option value="" disabled selected>Seleccione la ciudad de destino</option>
					    					    <?php foreach ($lst_paisCiudad as $ciudad) {?>
					    				<option value="<?php echo $ciudad->ID_CIUDAD ?>"><?php echo $ciudad->CIUDAD ?></option>
					    			<?php } ?>
					    			</select>
					    					
					    					
				    			</div>
				    			<div class="col-md-4 col-xs-6 col-sm-4">
				    				<label for="lblFecha">Fecha de ida</label>
				    						<!--<input type="date" class="form-control" name="fida[]" id="fida" >-->
				    				<div class='input-group date' id='datetimepicker_fida' onClick="picker(this.id);">
				    						  <input type='text' class="form-control" name="fida[]" id="fida"/>
				    						  <span class="input-group-addon">
				    						      <span class="glyphicon glyphicon-calendar"></span>
				    						  </span>
				    				</div>

				    						<!--<input type="datetime-local">-->
				    						
				    			</div>
				    			<div class="col-md-4 col-xs-6 col-sm-4" id="dateReturn">
				    				<label for="lblFechaRegreso">Fecha de regreso</label>
				    				<!--<input type="date" class="form-control" name="fregreso[]" id="fregreso">-->
				    				<div class='input-group date' id='datetimepicker_fregreso'>
				    						  <input type='text' class="form-control" name="fregreso[]" id="fregreso"/>
				    						  <span class="input-group-addon">
				    						      <span class="glyphicon glyphicon-calendar"></span>
				    						  </span>
				    				</div>
				    			</div>

				    		</div>
				    		<div class="row" id="result-clonVuelo"></div>
				    		<br>					    					
							<div class="mdl-card__actions mdl-card--border">
								<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="agregaDestino">
									   Agregar Destino
								</a>
								<a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="eliminaDestino">
									   Eliminar Destino
								</a>
							</div>
						</div>

				  	</div>
				</div><!-- END CARD FLY -->

				<div id="dataHotel"><!-- CARD HOTEL -->				    	    	
					<div class="demo-card-square mdl-card mdl-shadow--2dp">
					    <div class="mdl-card__title mdl-card--expand" id="titulo_hotel">
					    	   <h2 class="mdl-card__title-text" >Información del hotel</h2>
					    </div>
					    <div class="mdl-card__supporting-text">
						    <div class="row" id="fila-hotel1" onclick="picker(this.id)">
						    	<div class="col-md-4 col-xs-6 col-sm-4">
						    	    <label for="lblOrigen">Nombre hotel y/o Cuidad</label>
						    	    <select class="form-control" name="txt_ciudadhotel[]" id="txt_ciudadhotel">
						    	    		  <option value="" disabled selected>Seleccione</option>
						    	    		  <?php foreach ($lst_paisCiudad as $ciudad) {?>
						    	    		   <option value="<?php echo $ciudad->ID_CIUDAD ?>"><?php echo $ciudad->CIUDAD ?></option>
						    	    		    <?php } ?>
						    	    		    		    
						    	    </select>
						    	</div>
						    	<div class="col-md-4 col-xs-6 col-sm-4">
						    		<label for="lblFecha">Fecha de Ingreso</label>
						    		<!--<input type="date" class="form-control" name="fingreso_hotel[]" id="fingreso_hotel">-->
						    		<div class='input-group date' id='datetimepicker_fingreso' >
						    	    	<input type='text' class="form-control" name="fingreso_hotel[]" id="fingreso_hotel"/>
						    	    	<span class="input-group-addon">
						    	    		  	<span class="glyphicon glyphicon-calendar"></span>
						    	    	</span>
						    		</div>
						    	</div>
						    	<div class="col-md-4 col-xs-6 col-sm-4">
						    		<label for="lblFecha">Fecha de Salida</label>
						    		<!--<input type="date" class="form-control" name="fsalida_hotel[]" id="fsalida_hotel">-->
						    		<div class='input-group date' id='datetimepicker_fsalida'>
						    	    	<input type='text' class="form-control" name="fsalida_hotel[]" id="fsalida_hotel"/>
						    	    	<span class="input-group-addon">
						    	    		  	<span class="glyphicon glyphicon-calendar"></span>
						    	    	</span>
						    		</div>
						    	</div>

						    </div>
						    <div class="row" id="result-clonardiv"></div>
					    </div>
					    <div class="mdl-card__actions mdl-card--border">
					    	   <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="mas">
					    	    		      Agregar Hotel
					    	   </a>
					    	   <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="menos">
					    	    		      Eliminar Hotel
					    	   </a>
					    </div>
					</div>
				</div><!-- END CARD HOTEL -->

			</div>						
			<div class="mdl-cell mdl-cell--4-col mdl-cell--2-col-tablet"> <!-- CELL OF FILTERS -->
				
				<div id="filtroVuelo">
					<div class="demo-card-square mdl-card mdl-shadow--2dp">
					  <div class="mdl-card__title mdl-card--expand">
					    <h2 class="mdl-card__title-text">Opciones de vuelo</h2>
					  </div>
					  <div class="mdl-card__supporting-text">
					    <div class="mdl-grid">					    	
					    	<select name="select_op" id="select_op" class="form-control" onChange="validaUno(this.value)">
					    		<option value="vuelo">Vuelo</option>
					    		<option value="hotel">Hotel</option>
					    		<option value="vueloHotel">Vuelo + Hotel</option>
					    	</select>				    	
					    </div>
						<div class="mdl-grid">
							<select name="select_opvuelo" id="select_opvuelo" class="form-control" onChange="validaDos(this.value)">
								<option value="ida">Vuelo de ida</option>
								<option value="idaregreso">Vuelo de ida y regreso</option>
							</select>
						</div>

						<div class="mdl-grid">
					    	<select name="select_tercero" id="select_tercero" class="form-control" onChange="validaTercero(this.value)">
					    		<option value="0" disabled selected>¿ Esta reserva es para un tercero ?</option>
					    		<option value="si">Si</option>
					    		<option value="no">No</option>
					    	</select>
					    </div>



					  </div>
					  <!--<div class="mdl-card__actions mdl-card--border">
					    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
					      View Updates
					    </a>
					  </div>-->
					</div>
				</div>

				<div id="infoTerceros">
					<div class="demo-card-square mdl-card mdl-shadow--2dp">
					  <div class="mdl-card__title mdl-card--expand">
					    <h2 class="mdl-card__title-text">Informacion del tercero</h2>
					  </div>
					  <div class="mdl-card__supporting-text">
					  	<div class="mdl-grid">
					  		<select name="select_tipdoc" id="select_tipdoc" class="form-control">
					  			<option value="0" selected disabled>Seleccione un tipo de documento</option>
					  			<option value="cc">Cédula de ciudadania</option>
					  			<option value="ce">Cédula de extrangeria</option>
					  			<option value="pas">Pasaporte</option>
					  		</select>
					  	</div>
					    <div class="mdl-grid">
					    	<label for="doctercer">Numero de documento</label>					    	
							<input type="number" class="form-control" placeholder="Numero de documento" name="txt_doctercero" id="txt_doctercero" min="0">				    	
					    </div>
						<div class="mdl-grid">
							<label for="lblnom">Nombre del tercero</label>
							<input type="text" class="form-control" placeholder="Nombre completo" name="txt_nomtercero" id="txt_nomtercero">	
						</div>

						<div class="mdl-grid">
							<label for="lblFechaNacimiento">Fecha de nacimiento</label>
							<!--<input type="date" class="form-control" name="fregreso[]" id="fregreso">-->
							<div class='input-group date' id='datetimepicker_fnacimiento'>
									  <input type='text' class="form-control" name="fnacimiento" id="fnacimiento"/>
									  <span class="input-group-addon">
									      <span class="glyphicon glyphicon-calendar"></span>
									  </span>
							</div>	
						</div>
						<div class="mdl-grid">
							<label for="telcontacto">Teléfono o celular de contacto</label>
							<input type="number" min="0" class="form-control" id="txt_teltercero">
						</div>





					  </div>
					  <!--<div class="mdl-card__actions mdl-card--border">
					    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
					      View Updates
					    </a>
					  </div>-->
					</div>
				</div>

		

			</div> <!-- END CELL OF FILTERS -->
 		</div>
 		<div class="mdl-grid">

 			<button class="btn btn-primary btn-large" style="width:100%; " id="btn_registrar">Registrar</button>
 		</div>
 		</form>
    </div>
</main>


<script src="<?php echo base_url();?>js/script/nuevareserva.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/moment.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/bootstrap-datetimepicker.es.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/es-ES.js"></script>