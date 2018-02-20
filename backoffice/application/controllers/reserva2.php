<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva2 extends CI_Controller {



  function __construct(){
      parent::__construct();
      $this->load->model('reserva_model');

  }
  function index(){
  		
  		$dato['titulo']="Reserva";
  		$data['lst_paisCiudad']= $this->reserva_model->getPaisCiudad();

  		$this->load->view('templates/header',$dato);
      $this->load->view('reserva_view',$data);
      $this->load->view('templates/footer');
  }


  function insertar(){
    /*OCULTA LOS ERRORES DE TIPO NOTICE*/  
    //error_reporting(E_ALL ^ E_NOTICE);
    
    $opcionReserva=$_POST['opcionReserva'];
    $opcionVuelo=$_POST['opcionVuelo'];
    
    $dateTime=date('Y/m/d h:i:s', time());

   

    

    /*Esta es la opcion para registrar solamente los vuelos*/
    if ($opcionReserva=="vuelo") {
        $vuelo="S";
        $hotel="N";

        if ($opcionVuelo=="idaRegreso") {
          
          $opVueloIR="S";

          $items1 = ($_POST['txt_origen']);    
          $items2 = ($_POST['txt_destino']);
          $items3 = ($_POST['fida']);
          $items4 = ($_POST['fregreso']);
          /* ------------------------------------------------------------------- */
          /*  ------------------------SECCION PARA LA RESERVA --------------------*/
          $dataReserva = array(
                "COD_RESERVA" => NULL,
                "FECHA_RESERVA" => $dateTime,
                "HOTEL_RESERVA" => $hotel,
                "VUELO_RESERVA" => $vuelo,
                "VIDAREGRESO_HOTEL" => $opVueloIR,
                "OBSERVACION_RESERVA" => NULL,
                "FAUTORIZACION_RESERVA" => NULL,
                "ESTADO_RESERVA" => "Pendiente",
                "ESPORADICO_USUARIO" => NULL,
                "ID_USUARIO" => "dzambrano"
              );
          print_r($dataReserva);
          echo "<br>";
          echo "<hr>";
          //$this->reserva_model->insertarReserva($dataReserva);

          $dato['numeroMaximo']= $this->reserva_model->numMaxReserva();
          $codReserva = $dato['numeroMaximo']->NUMMAXRESERVA;

            while(true)
            {

              $item1 = current($items1);
              $item2 = current($items2);
              $item3 = current($items3);
              $item4 = current($items4);

              echo $item1;
              echo "<br>";
              echo "<hr>";
              echo $item2;
              echo "<br>";
              echo "<hr>";
              echo $item3;
              echo "<br>";
              echo "<hr>";

                  $origen=(( $item1 !== false) ? $item1 : ", &nbsp;");
                  $destino=(( $item2 !== false) ? $item2 : ", &nbsp;");
                  $fida=(( $item3 !== false) ? $item3 : ", &nbsp;");
                  $fregreso=(( $item4 !== false) ? $item4 : ", &nbsp;");

                  echo $origen;
                  echo "<br>";
                  echo "<hr>";
                  echo $destino;
                  echo "<br>";
                  echo "<hr>";
                  echo $fida;
                  echo "<br>";
                  echo "<hr>";

                  /*Se arman los arreglos para insertar los valores*/

                  $datosOrigen = array(
                      "ID_ORIGEN" => NULL,
                      "ID_CIUDAD" => $origen,
                      "COD_RESERVA" => $codReserva,
                      "FECHA_ORIGEN" => $fida
                    );
                  $datosDestino = array(
                      "ID_DESTINO" => NULL,
                      "ID_CIUDAD" => $destino,
                      "COD_RESERVA" => $codReserva,
                      "FECHA_DESTINO" => $fregreso
                    );

                  /*------------ REVISAR LA VALIDACION DE QUE GUARDE SI ENVIO SOLO RESERVA O SI ENVIO SOLO HOTEL O JUNTOS -------------- ---------*/ 
                 print_r($datosOrigen);
                 // $this->reserva_model->insertarVuelo($datosOrigen,$datosDestino);


                      $item1 = next( $items1 );
                      $item2 = next( $items2 );
                      $item3 = next( $items3 );
                      $item4 = next( $items4 );
                      

                  //check terminator acciones
                  if($item1 === false && $item2 === false && $item3 === false && $item4 === false ) break;


              

            }
          /*End While*/
        }
        else
        {
          $opVueloIR="N";

          $items1 = ($_POST['txt_origen']);    
          $items2 = ($_POST['txt_destino']);
          $items3 = ($_POST['fida']);
          /* ------------------------------------------------------------------- */
          /*  ------------------------SECCION PARA LA RESERVA --------------------*/
          $dataReserva = array(
                "COD_RESERVA" => NULL,
                "FECHA_RESERVA" => $dateTime,
                "HOTEL_RESERVA" => $hotel,
                "VUELO_RESERVA" => $vuelo,
                "VIDAREGRESO_HOTEL" => $opVueloIR,
                "OBSERVACION_RESERVA" => NULL,
                "FAUTORIZACION_RESERVA" => NULL,
                "ESTADO_RESERVA" => "Pendiente",
                "ESPORADICO_USUARIO" => NULL,
                "ID_USUARIO" => "dzambrano"
              );

          $this->reserva_model->insertarReserva($dataReserva);
          
          $dato['numeroMaximo']= $this->reserva_model->numMaxReserva();
          $codReserva = $dato['numeroMaximo']->NUMMAXRESERVA;

            while(true)
            {

              $item1 = current($items1);
              $item2 = current($items2);
              $item3 = current($items3);




                  $origen=(( $item1 !== false) ? $item1 : ", &nbsp;");
                  $destino=(( $item2 !== false) ? $item2 : ", &nbsp;");
                  $fida=(( $item3 !== false) ? $item3 : ", &nbsp;");


                  /*Se arman los arreglos para insertar los valores*/

                  $datosOrigen = array(
                      "ID_ORIGEN" => NULL,
                      "ID_CIUDAD" => $origen,
                      "COD_RESERVA" => $codReserva,
                      "FECHA_ORIGEN" => $fida
                    );
                  $datosDestino = array(
                      "ID_DESTINO" => NULL,
                      "ID_CIUDAD" => $destino,
                      "COD_RESERVA" => $codReserva,
                      "FECHA_DESTINO" => '0000-00-00'
                    );

                  /*------------ REVISAR LA VALIDACION DE QUE GUARDE SI ENVIO SOLO RESERVA O SI ENVIO SOLO HOTEL O JUNTOS -------------- ---------*/ 
                  $this->reserva_model->insertarVuelo($datosOrigen,$datosDestino);


                      $item1 = next( $items1 );
                      $item2 = next( $items2 );
                      $item3 = next( $items3 );

                      

                  //check terminator acciones
                  if($item1 === false && $item2 === false && $item3 === false ) break;


              

            }
          /*End While*/
        }
      }

      

    
    /*Esta es la opcion para registrar solamente los hoteles*/
    elseif ($opcionReserva=="hotel") {
      $vuelo="N";
      $hotel="S";

      $items5 = ($_POST['txt_ciudadhotel']);
      $items6 = ($_POST['fingreso_hotel']);
      $items7 = ($_POST['fsalida_hotel']);
      /* ------------------------------------------------------------------- */
      /*  ------------------------SECCION PARA LA RESERVA --------------------*/
      $dataReserva = array(
            "COD_RESERVA" => NULL,
            "FECHA_RESERVA" => $dateTime,
            "HOTEL_RESERVA" => $hotel,
            "VUELO_RESERVA" => $vuelo,
            "VIDAREGRESO_HOTEL" => $opVueloIR,
            "OBSERVACION_RESERVA" => NULL,
            "FAUTORIZACION_RESERVA" => NULL,
            "ESTADO_RESERVA" => "Pendiente",
            "ESPORADICO_USUARIO" => NULL,
            "ID_USUARIO" => "dzambrano"
          );

      $this->reserva_model->insertarReserva($dataReserva);
      $dato['numeroMaximo']= $this->reserva_model->numMaxReserva();
      $codReserva = $dato['numeroMaximo']->NUMMAXRESERVA;
        while(true)
        {
          $item5 = current($items5);
          $item6 = current($items6);
          $item7 = current($items7);

              
              $ciudadhotel=(( $item5 !== false) ? $item5 : ", &nbsp;");
              $fingreso=(( $item6 !== false) ? $item6 : ", &nbsp;");
              $fsalida=(( $item7 !== false) ? $item7 : ", &nbsp;");

              /*Se insertan los valores*/

              $datosHotel = array(
                "CODRESERVA_HOTEL" => $codReserva,
                "CIUDAD_HOTEL" => $ciudadhotel,
                "FINGRESO_HOTEL" => $fingreso,
                "FSALIDA_HOTEL" => $fsalida
              );

              /*------------ REVISAR LA VALIDACION DE QUE GUARDE SI ENVIO SOLO RESERVA O SI ENVIO SOLO HOTEL O JUNTOS -------------- ---------*/ 
              $this->reserva_model->insertarHotel($datosHotel);

                  $item5 = next( $items5 );
                  $item6 = next( $items6 );
                  $item7 = next( $items7 );

              //check terminator acciones
              if($item5 === false && $item6 === false && $item7 === false) break;


          

        }
      /*End While*/

    }
    /*Esta es la opcion para registrar los vuelos mas los hoteles*/
    else{
      $vuelo="S";
      $hotel="S";

      if ($opcionVuelo=="idaRegreso") {
        $opVueloIR="S";

        $items1 = ($_POST['txt_origen']);    
        $items2 = ($_POST['txt_destino']);
        $items3 = ($_POST['fida']);
        $items4 = ($_POST['fregreso']);

        $items5 = ($_POST['txt_ciudadhotel']);
        $items6 = ($_POST['fingreso_hotel']);
        $items7 = ($_POST['fsalida_hotel']);
        /* ------------------------------------------------------------------- */
        /*  ------------------------SECCION PARA LA RESERVA --------------------*/
          $dataReserva = array(
                "COD_RESERVA" => NULL,
                "FECHA_RESERVA" => $dateTime,
                "HOTEL_RESERVA" => $hotel,
                "VUELO_RESERVA" => $vuelo,
                "VIDAREGRESO_HOTEL" => $opVueloIR,
                "OBSERVACION_RESERVA" => NULL,
                "FAUTORIZACION_RESERVA" => NULL,
                "ESTADO_RESERVA" => "Pendiente",
                "ESPORADICO_USUARIO" => NULL,
                "ID_USUARIO" => "dzambrano"
              );

          $this->reserva_model->insertarReserva($dataReserva);
          $dato['numeroMaximo']= $this->reserva_model->numMaxReserva();
          $codReserva = $dato['numeroMaximo']->NUMMAXRESERVA;

          /*  ------------------------------------------------------------------*/

          while(true)
          {

            $item1 = current($items1);
            $item2 = current($items2);
            $item3 = current($items3);
            $item4 = current($items4);

            $item5 = current($items5);
            $item6 = current($items6);
            $item7 = current($items7);



                $origen=(( $item1 !== false) ? $item1 : ", &nbsp;");
                $destino=(( $item2 !== false) ? $item2 : ", &nbsp;");
                $fida=(( $item3 !== false) ? $item3 : ", &nbsp;");
                $fregreso=(( $item4 !== false) ? $item4 : ", &nbsp;");
                
                $ciudadhotel=(( $item5 !== false) ? $item5 : ", &nbsp;");
                $fingreso=(( $item6 !== false) ? $item6 : ", &nbsp;");
                $fsalida=(( $item7 !== false) ? $item7 : ", &nbsp;");


                /*Se insertan los valores*/

                $datosOrigen = array(
                    "ID_ORIGEN" => NULL,
                    "ID_CIUDAD" => $origen,
                    "COD_RESERVA" => $codReserva,
                    "FECHA_ORIGEN" => $fida
                  );
                $datosDestino = array(
                    "ID_DESTINO" => NULL,
                    "ID_CIUDAD" => $destino,
                    "COD_RESERVA" => $codReserva,
                    "FECHA_DESTINO" => $fregreso
                  );

                $datosHotel = array(
                  "CODRESERVA_HOTEL" => $codReserva,
                  "CIUDAD_HOTEL" => $ciudadhotel,
                  "FINGRESO_HOTEL" => $fingreso,
                  "FSALIDA_HOTEL" => $fsalida
                );

                /*------------ REVISAR LA VALIDACION DE QUE GUARDE SI ENVIO SOLO RESERVA O SI ENVIO SOLO HOTEL O JUNTOS -------------- ---------*/ 
                $this->reserva_model->insertar($datosOrigen,$datosDestino,$datosHotel);


                    $item1 = next( $items1 );
                    $item2 = next( $items2 );
                    $item3 = next( $items3 );
                    $item4 = next( $items4 );
                    $item5 = next( $items5 );
                    $item6 = next( $items6 );
                    $item7 = next( $items7 );

                //check terminator acciones
                if($item1 === false && $item2 === false && $item3 === false && $item4 === false && $item5 === false 
                  && $item6 === false && $item7 === false) break;


            

          }
        /*End While*/

      }
      else
      {
        $opVueloIR="N";

          $items1 = ($_POST['txt_origen']);    
          $items2 = ($_POST['txt_destino']);
          $items3 = ($_POST['fida']);


          $items5 = ($_POST['txt_ciudadhotel']);
          $items6 = ($_POST['fingreso_hotel']);
          $items7 = ($_POST['fsalida_hotel']);
          /* ------------------------------------------------------------------- */
          /*  ------------------------SECCION PARA LA RESERVA --------------------*/
            $dataReserva = array(
                  "COD_RESERVA" => NULL,
                  "FECHA_RESERVA" => $dateTime,
                  "HOTEL_RESERVA" => $hotel,
                  "VUELO_RESERVA" => $vuelo,
                  "VIDAREGRESO_HOTEL" => $opVueloIR,
                  "OBSERVACION_RESERVA" => NULL,
                  "FAUTORIZACION_RESERVA" => NULL,
                  "ESTADO_RESERVA" => "Pendiente",
                  "ESPORADICO_USUARIO" => NULL,
                  "ID_USUARIO" => "dzambrano"
                );

            $this->reserva_model->insertarReserva($dataReserva);
            $dato['numeroMaximo']= $this->reserva_model->numMaxReserva();
            $codReserva = $dato['numeroMaximo']->NUMMAXRESERVA;

            /*  ------------------------------------------------------------------*/

            while(true)
            {

              $item1 = current($items1);
              $item2 = current($items2);
              $item3 = current($items3);

              $item5 = current($items5);
              $item6 = current($items6);
              $item7 = current($items7);



                  $origen=(( $item1 !== false) ? $item1 : ", &nbsp;");
                  $destino=(( $item2 !== false) ? $item2 : ", &nbsp;");
                  $fida=(( $item3 !== false) ? $item3 : ", &nbsp;");
                  
                  $ciudadhotel=(( $item5 !== false) ? $item5 : ", &nbsp;");
                  $fingreso=(( $item6 !== false) ? $item6 : ", &nbsp;");
                  $fsalida=(( $item7 !== false) ? $item7 : ", &nbsp;");


                  /*Se insertan los valores*/

                  $datosOrigen = array(
                      "ID_ORIGEN" => NULL,
                      "ID_CIUDAD" => $origen,
                      "COD_RESERVA" => $codReserva,
                      "FECHA_ORIGEN" => $fida
                    );
                  $datosDestino = array(
                      "ID_DESTINO" => NULL,
                      "ID_CIUDAD" => $destino,
                      "COD_RESERVA" => $codReserva,
                      "FECHA_DESTINO" => "0000-00-00"
                    );

                  $datosHotel = array(
                    "CODRESERVA_HOTEL" => $codReserva,
                    "CIUDAD_HOTEL" => $ciudadhotel,
                    "FINGRESO_HOTEL" => $fingreso,
                    "FSALIDA_HOTEL" => $fsalida
                  );

                  /*------------ REVISAR LA VALIDACION DE QUE GUARDE SI ENVIO SOLO RESERVA O SI ENVIO SOLO HOTEL O JUNTOS -------------- ---------*/ 
                  $this->reserva_model->insertar($datosOrigen,$datosDestino,$datosHotel);


                      $item1 = next( $items1 );
                      $item2 = next( $items2 );
                      $item3 = next( $items3 );
                      $item5 = next( $items5 );
                      $item6 = next( $items6 );
                      $item7 = next( $items7 );

                  //check terminator acciones
                  if($item1 === false && $item2 === false && $item3 === false && $item5 === false 
                    && $item6 === false && $item7 === false) break;


              

            }
          /*End While*/
        
      }

    }
    /*End Else Global*/
    
  }
  /*END FUNCTION INSERTAR()*/

  

}
?>
