<main class="mdl-layout__content">
	<!-- CONTENT PAGE-->
  <div class="page-content dwc-margin-body">
		<!-- TARGER PRIMARY -->
     	<div class="demo-card-square mdl-card mdl-shadow--2dp">
  	    	<div class="mdl-card__title mdl-card--expand">
  	    		<!-- TITLE -->
  	    	   	<h2 class="mdl-card__title-text">Mis reservas</h2>
  	    	</div>
  	    	<div class="mdl-card__supporting-text">
  	    		<!-- CONTENT -->
  	    		<div class="table-responsive">
  		    	   	<table class="table" id="table_allreservas">
  		    	   	  <thead>
  		    	   	    <tr>
  		    	   	      <th class="mdl-data-table__cell--non-numeric"># reserva</th>
  		    	   	      <th>Fecha reserva</th>
  		    	   	      <th>Requiere Vuelo</th>
  		    	   	      <th>Requiere Hotel</th>
  		    	   	      <th>Vuelo Ida y Regreso</th>
  		    	   	      <th>Origen</th>
  		    	   	      <th>Destino</th>
                      <th>Fecha de salida</th>
                      <th>Fecha de llegada</th>
  		    	   	      <th>Estado</th>
                      <th>Acciones</th>
  		    	   	    </tr>
  		    	   	  </thead>
  		    	   	  <tbody>
                  <?php foreach ($reservas->result() as $resulReservas ) { 
                    ?>
                    <tr class="" >
                        <td id="codRe"><?php echo $resulReservas->COD_RESERVA ?></td>
                        <td ><?php echo $resulReservas->FECHA_RESERVA?></td>
                        <td align="center"><?php echo $resulReservas->VUELO_RESERVA ?></td>
                        <td align="center"><?php echo $resulReservas->HOTEL_RESERVA ?></td>
                        <td align="center"><?php echo $resulReservas->VIDAREGRESO_HOTEL ?></td>
                        <td><?php echo $resulReservas->ORIGEN ?></td>
                        <td><?php echo $resulReservas->DESTINO ?></td>
                        <td><?php if ($resulReservas->FECHA_ORIGEN=="0000-00-00 00:00:00") {
                          echo " ";
                        }else
                        {
                          echo $resulReservas->FECHA_ORIGEN;
                        }
                        ?></td>
                        <td><?php if ($resulReservas->FECHA_DESTINO=="0000-00-00 00:00:00") {
                          echo " ";
                        }else
                        {
                          echo $resulReservas->FECHA_DESTINO;
                        }
                        ?></td>
                        <td><?php switch ($resulReservas->ESTADO_RESERVA) {
                                case 'Pendiente':
                                  echo '<span class="label label-warning">'.$resulReservas->ESTADO_RESERVA.'</span>';
                                break;
                                case 'Autorizado':
                                  echo '<span class="label label-success">'.$resulReservas->ESTADO_RESERVA.'</span>';
                                break;
                                case 'Rechazado':
                                  echo '<span class="label label-danger">'.$resulReservas->ESTADO_RESERVA.'</span>';
                                break;

                              }
                        ?></td>
                        <td > 
                          <button class="mdl-button mdl-js-button mdl-button--icon  " id="<?php echo 'btn'.$resulReservas->COD_RESERVA ?>" onClick="showAll(this.id)">
                            <i class="material-icons " >visibility</i>
                          </button>
                          <button class="mdl-button mdl-js-button mdl-button--icon mdl-button--colored" id="btn_liberarReserva">
                            <i class="material-icons">send</i>
                          </button>
                        </td>
                    </tr>
                  <?php  
                  } ?>
  		    	   	    
  		    	   	    
  		    	   	  </tbody>
  		    	   	</table>

              </div>

  	    	</div>
  	    			<!-- FOOTER TARGET -->
  	    	    	<!--<div class="mdl-card__actions mdl-card--border">

  	    	    	</div>-->
  	    	    	<!-- END FOOTER TARGET -->
      	</div>		
			<!-- END TARGET PRIMARY -->
      
     
<!-- END CONTENT PAGE -->
  </div>




</main>
<!-- WINDOWS MODAL -->
    <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" >
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 id="title-modal"></h4>
            </div>
            <div class="modal-body" style="">
            <?php foreach ($resulVuelo->result() as $resVuelo ) { 
              ?>

              <div class="row">
                  <div class="col-md-4 col-xs-6 col-sm-4">
                     <div class="form-group">
                       <label for="usrname">Documento</label>
                       <input type="text" class="form-control" id="txt_ndocumento" value="<?php echo $resVuelo->COD_RESERVA ?>">
                     </div> 
                  </div>
                  <div class="col-md-4 col-xs-6 col-sm-4">
                      <div class="form-group">
                        <label for="usrname">Nombre Completo</label>
                        <input type="text" class="form-control" id="txt_nomcompleto" >
                      </div>
                  </div>
                  <div class="col-md-4 col-xs-6 col-sm-4">
                      <div class="form-group">
                        <label for="usrname">Motivo Viaje</label>
                        <input type="text" class="form-control" id="txt_motviaje" >
                      </div>
                  </div>
              </div>
              <hr>
                  <h4 class="bg-primary" style="height: 40px; text-align: center;">Información del vuelo</h4>              
           
              <table class="table">
                <tr>
                  <td>Origen</td>
                  <td>destino</td>
                  <td>fecha ida</td>
                  <td>fecha regreso</td>
                </tr>
                <tr>
                  <td><?php echo $resVuelo->ORIGEN ?></td>
                  <td><?php echo $resVuelo->DESTINO ?></td>
                  <td><?php echo $resVuelo->FECHA_ORIGEN ?></td>
                  <td><?php echo $resVuelo->FECHA_DESTINO ?></td>
                </tr>
              </table>
              <hr>
              <div class="row">
                  <div class="col-md-6 col-xs-6 col-sm-4">
                      <div class="form-group">
                        <label for="usrname">Origen</label>
                        <input type="text" class="form-control" id="usrname" placeholder="Enter email" value="<?php echo $resVuelo->ORIGEN ?>">
                      </div>
                  </div>
                  <div class="col-md-6 col-xs-6 col-sm-4">
                      <div class="form-group">
                        <label for="usrname">Destino</label>
                        <input type="text" class="form-control" id="usrname" placeholder="Enter email" value="<?php echo $resVuelo->DESTINO ?>">
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-4 col-xs-6 col-sm-4">
                   
                   <div class="form-group">
                     <label for="usrname">Fecha ida</label>
                     <input type="text" class="form-control" id="usrname" placeholder="Enter email" value="<?php echo $resVuelo->FECHA_ORIGEN ?>">
                   </div> 
                </div>
                <div class="col-md-4 col-xs-6 col-sm-4">
                   
                   <div class="form-group">
                     <label for="usrname">Fecha regreso</label>
                     <input type="text" class="form-control" id="usrname" placeholder="Enter email" value="<?php echo $resVuelo->FECHA_DESTINO ?>">
                   </div> 
                </div>
                <div class="col-md-4 col-xs-6 col-sm-4">
                   
                   <div class="form-group">
                     <label for="usrname">Vuelo Ida y Regreso</label>
                     <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                   </div> 
                </div>
              </div>
              <?php } ?>
              <h4 class="bg-warning" style="height: 40px; text-align: center; background: #f0ad4e; color:white; /*border-bottom: 6px solid red;*/">Información del hotel</h4> 
                  <div class="row">
                      <div class="col-md-4 col-xs-6 col-sm-4">
                         
                         <div class="form-group">
                           <label for="usrname">Ciudad hospedaje</label>
                           <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                         </div> 
                      </div>
                      <div class="col-md-4 col-xs-6 col-sm-4">
                          <div class="form-group">
                            <label for="usrname">Fecha de ingreso</label>
                            <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                          </div>
                      </div>
                      <div class="col-md-4 col-xs-6 col-sm-4">
                          <div class="form-group">
                            <label for="usrname">Fecha de salida</label>
                            <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                          </div>
                      </div>
                  </div>
                <h4 class="bg-warning" style="height: 40px; text-align: center; background: #f0ad4e; color:white; /*border-bottom: 6px solid red;*/">Espacio para ser diligenciado por Duwest Colombia SAS</h4> 
                  <div class="row">
                    <div class="col-md-4 col-xs-6 col-sm-4">
                       
                       <div class="form-group">
                         <label for="usrname">Estado</label>
                         <select name="cmb_estado" id="cmb_estado" class="form-control">
                           <option value="Autorizado">Autorizado</option>
                           <option value="Pendiente">Pendiente</option>
                           <option value="Rechazado">Rechazado</option>
                         </select>
                       </div> 
                    </div>
                    <div class="col-md-4 col-xs-6 col-sm-4">
                       
                       <div class="form-group">
                         <label for="usrname">Observación</label>
                         <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                       </div> 
                    </div>
                    <div class="col-md-4 col-xs-6 col-sm-4">
                       
                       <div class="form-group">
                         <label for="usrname">Valor Vuelo</label>
                         <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                       </div> 
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 col-xs-6 col-sm-4">
                       
                       <div class="form-group">
                         <label for="usrname">Valor Hotel</label>
                         <input type="text" class="form-control" id="usrname" placeholder="Enter email">
                       </div> 
                    </div>

                  </div>
             </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success">Registrar</button>
              <button type="submit" class="btn btn-danger btn-default " data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>

            </div>
          </div>
          
        </div>
      </div> 
    </div>
<!-- END MODAL -->

<script src="<?php echo base_url();?>js/script/allreservas.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>-->