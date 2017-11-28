<style>
  	.btn-reg{
		margin-left: 55px; 
		margin-bottom:25px; 
  	}
	.dw-hr{

		margin-right: 55px;
		margin-left: 55px;
		/*-webkit-box-shadow: 5px 1px 1px 1px rgba(0,0,0,0.35);
		-moz-box-shadow: 5px 1px 1px 1px rgba(0,0,0,0.35);
		box-shadow: 5px 1px 1px 1px rgba(0,0,0,0.35);*/
	}
	#titulo_hotel{
		background: #f57c00;
	}
	#titulo_vuelo{
		background: #2196f3;
	}
  </style>
  
  <main class="mdl-layout__content">

    <div class="page-content dwc-margin-body">
    	<!-- CONTENIDO DE LA PAGINA AQUI -->
		<div class="demo-card-square mdl-card mdl-shadow--2dp">
			<div class="mdl-card__title mdl-card--expand">
			    <h2 class="mdl-card__title-text">Nueva Reserva</h2>
			</div>

			<div class="mdl-card__supporting-text">
				<h4 class="mdl-card__title-text">Filtros para reserva</h4>
				<br>   
		    	<div class="row ">
		    		<div class="col-md-4 col-xs-6 col-sm-4">
		    			<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioVuelo">
		    		 	  <input type="radio" id="radioVuelo" class="mdl-radio__button" name="options" value="vuelo" onChange="validaUno(this.value)">
		    		 	  <span class="mdl-radio__label">Vuelo</span>
		    		 	</label>
		    		</div>
		    		<div class="col-md-4 col-xs-6 col-sm-4">
		    				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioHotel">
		    			 	  <input type="radio" id="radioHotel" class="mdl-radio__button" name="options" value="hotel" onChange="validaUno(this.value)">
		    			 	  <span class="mdl-radio__label">Hotel</span>
		    			 	</label>
		    		</div>
		    		<div class="col-md-4 col-xs-6 col-sm-4">
		    				<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioVueloHotel">
		    			 	  <input type="radio" id="radioVueloHotel" class="mdl-radio__button" name="options" value="vueloHotel" onChange="validaUno(this.value)">
		    			 	  <span class="mdl-radio__label">Vuelo + Hotel</span>
		    			 	</label>
		    		</div>
		    	</div>
		    
		    	<br>
		    	<div id="OpVuelo">
		    		<div class="row">
		    			<div class="col-md-8 col-xs-6 col-sm-4">
		    				<h5>Opciones de vuelo</h5>
		    			</div>
		    		
		    		</div>
		    		<div class="row">
		    			
		    				<div class="col-md-4 col-xs-6 col-sm-4">
		    					<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioIda">
		    					  <input type="radio" id="radioIda" class="mdl-radio__button" name="options" value="ida" onChange="validaDos(this.value)">
		    					  <span class="mdl-radio__label">Ida</span>
		    					</label>
		    				</div>
		    				<div class="col-md-4 col-xs-6 col-sm-4">
		    					<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioIdaRegreso">
		    					  <input type="radio" id="radioIdaRegreso" class="mdl-radio__button" name="options" value="idaRegreso" onChange="validaDos(this.value)">
		    					  <span class="mdl-radio__label">Ida y Regreso</span>
		    					</label>
		    				</div>

		    		</div>
	    		</div>


	    		<div id="opterceros">
	    			<div class="row">
	    				<div class="col-md-12 col-xs-6 col-sm-4">
	    					<h5>Reserva para terceros</h5>
	    				</div>
	    			</div>
	    			<div class="row">
	    					<div class="col-md-4 col-xs-6 col-sm-4">
	    						<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioSi">
	    						  <input type="radio" id="radioSi" class="mdl-radio__button" name="options" value="si" onChange="validaTercero(this.value)">
	    						  <span class="mdl-radio__label">Si</span>
	    						</label>
	    					</div>
	    					<div class="col-md-4 col-xs-6 col-sm-4">
	    						<label class="mdl-radio mdl-js-radio mdl-js-ripple-effect" for="radioNo">
	    						  <input type="radio" id="radioNo" class="mdl-radio__button" name="options" value="no" onChange="validaTercero(this.value)">
	    						  <span class="mdl-radio__label">No</span>
	    						</label>
	    					</div>

		    		</div>	    			
	    			
	    		</div>


	    		<br>
	    	</div>
    	</div>

		<br>
	<form name="frm_nuevareserva" id="frm_nuevareserva" action="<?php echo base_url();?>index.php/reserva/insertar" method="post">
    	<div id="dataVuelo">
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
    	</div>
    		
    	<hr class="dw-hr">	    			
    	<div id="dataHotel">
    	    	
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
    	</div>	
    

		

    	<!-- FIN CONTENIDO PAGINA -->	
    </div>
    <br>

    <input type="text" id="opcionReserva" name="opcionReserva" hidden="hidden">
    <input type="text" id="opcionVuelo" name="opcionVuelo" hidden="hidden">


	<button class="mdl-button mdl-js-button mdl-button--raised  mdl-js-ripple-effect mdl-button--accent btn-reg" id="btn_registrar">
		insertar
	</button>
	</form>


	<dialog class="mdl-dialog">
	    <div class="mdl-dialog__content">
	      <p>
	        Allow this site to collect usage data to improve your experience?
	      </p>
	    </div>
	    <div class="mdl-dialog__actions mdl-dialog__actions--full-width">
	      <button type="button" class="mdl-button">Agree</button>
	      <button type="button" class="mdl-button close">Disagree</button>
	    </div>
	</dialog>


  </main>

<script src="<?php echo base_url();?>js/script/nuevareserva.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/moment.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/bootstrap-datetimepicker.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/bootstrap-datetimepicker.es.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>js/datetimepicker/es-ES.js"></script>

  	