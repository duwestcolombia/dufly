<main class="mdl-layout__content">
	<!-- CONTENT PAGE-->
  <div class="page-content dwc-margin-body">
		<!-- TARGER PRIMARY -->
     	<div class="demo-card-square mdl-card mdl-shadow--2dp">
  	    	<div class="mdl-card__title mdl-card--expand">
  	    		<!-- TITLE -->
  	    	   	<h2 class="mdl-card__title-text">Mis reservas / Vuelos</h2>
  	    	</div>
  	    	<div class="mdl-card__supporting-text">
  	    		<!-- CONTENT -->
  	    		<div class="table-responsive">
  		    	   	<table class="table">
  		    	   	    <tr>
  		    	   	      <th class="mdl-data-table__cell--non-numeric"># reserva</th>
  		    	   	      <th>Origen</th>
  		    	   	      <th>Destino</th>
  		    	   	      <th>Fecha de ida</th>
  		    	   	      <th>Fecha de regreso</th>
  		    	   	      <th>Estado</th>
  		    	   	    </tr>
                    <?php foreach ($vuelos->result() as $resvuelos){?>
                        <tr>
                          <td><?php echo $resvuelos->COD_RESERVA?></td>
                          <td><?php echo $resvuelos->ORIGEN?></td>
                          <td><?php echo $resvuelos->DESTINO?></td>
                          <td><?php echo $resvuelos->FECHA_ORIGEN?></td>
                          <td><?php if ($resvuelos->FECHA_DESTINO=="0000-00-00 00:00:00") {
                            echo " ";
                          }else
                          {
                            echo $resvuelos->FECHA_DESTINO;
                          }
                          ?></td>

                          <td><?php switch ($resvuelos->ESTADO_RESERVA) {
                            case 'Pendiente':
                              echo '<span class="label label-warning">'.$resvuelos->ESTADO_RESERVA.'</span>';
                            break;
                            case 'Autorizado':
                              echo '<span class="label label-success">'.$resvuelos->ESTADO_RESERVA.'</span>';
                            break;
                            case 'Rechazado':
                              echo '<span class="label label-danger">'.$resvuelos->ESTADO_RESERVA.'</span>';
                            break;

                          }
                    ?></td>
                        </tr>
                    <?php } ?>
  		    	   	    
  		    	   	</table>

  		    	 </div>

  	    	</div>
  	    			<!-- FOOTER TARGET -->
  	    	    	<!--<div class="mdl-card__actions mdl-card--border">
  	    	    		   <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="mas">
  	    	    		     Agregar Hotel
  	    	    		   </a>
  	    	    		   <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="menos">
  	    	    		     Eliminar Hotel
  	    	    		   </a>
  	    	    	</div>-->
      	</div>		
			<!-- END TARGET PRIMARY -->
      <br>
      <!-- TARGET HOTELES -->
          <div class="demo-card-square mdl-card mdl-shadow--2dp">
              <div class="mdl-card__title mdl-card--expand">
                <!-- TITLE -->
                  <h2 class="mdl-card__title-text">Mis reservas / Hoteles</h2>
              </div>
              <div class="mdl-card__supporting-text">
                <!-- CONTENT -->
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                          <th class="mdl-data-table__cell--non-numeric"># reserva</th>
                          <th>Ciudad</th>
                          <th>Fecha de ingreso</th>
                          <th>Fecha de salida</th>
                          <th>Estado</th>
                        </tr>
                        <?php foreach ($hoteles->result() as $reshoteles){?>
                            <tr>
                              <td><?php echo $reshoteles->COD_RESERVA?></td>
                              <td><?php echo $reshoteles->HOTEL?></td>
                              <td><?php echo $reshoteles->FINGRESO_HOTEL?></td>
                              <td><?php echo $reshoteles->FSALIDA_HOTEL?></td>
                              <td><?php switch ($reshoteles->ESTADO_RESERVA) {
                                case 'Pendiente':
                                  echo '<span class="label label-warning">'.$reshoteles->ESTADO_RESERVA.'</span>';
                                break;
                                case 'Autorizado':
                                  echo '<span class="label label-success">'.$reshoteles->ESTADO_RESERVA.'</span>';
                                break;
                                case 'Rechazado':
                                  echo '<span class="label label-danger">'.$reshoteles->ESTADO_RESERVA.'</span>';
                                break;

                              }
                        ?></td>
                            </tr>
                        <?php } ?>
                        
                    </table>

                 </div>

              </div>
                  <!-- FOOTER TARGET -->
                    <!--<div class="mdl-card__actions mdl-card--border">
                         <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="mas">
                           Agregar Hotel
                         </a>
                         <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect" id="menos">
                           Eliminar Hotel
                         </a>
                    </div>-->
            </div>    


      <!-- END TARGET HOTELES -->

<!-- END CONTENT PAGE -->
  </div>

</main>