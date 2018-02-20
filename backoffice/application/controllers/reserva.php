<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva extends CI_Controller {



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

    $origenes = ($_POST['txt_origen']); 
    $destinos = ($_POST['txt_destino']);
    $fida = ($_POST['fida']);
    $fregreso = ($_POST['fregreso']); 

    $opVuelo = $_POST['select_op'];
    $opIdaReg = $_POST['select_opvuelo']; 
    $opTercero = $_POST['select_tercero'];

    
    
    $dateTime=date('Y/m/d h:i:s', time());


    switch ($opVuelo) {
        case 'vuelo':
          if ($opIdaReg == "ida") {
            
            $dataSolicitud = array(
              "COD_SOLICITUD"=>NULL,
              "VUELO_SOLICITUD"=>"S",
              "VIDAREGRESO_SOLICITUD"=>"N",
              "HOTEL_SOLICITUD"=>"N",
              "DOC_TERCERO"=>NULL,
              "TIPDOC_TERCERO"=>NULL,
              "OBSERVACION_SOLICITUD"=>NULL,
              "AUTORIZA_SOLICITUD"=>NULL,
              "REGPOR_SOLICITUD"=>"admintest",
              "FREG_SOLICITUD"=>$dateTime,
              "COD_EMPLEADO"=>"33001",
              "ESTADO_SOLICITUD"=>"Nueva"
            );

            $this->reserva_model->insertSolicitud($dataSolicitud);

            $numMaxSol = $this->reserva_model->numMaxSolicitud();

            for ($i=0; $i < count($origenes) ; $i++) { 
              
              $dataReserva = array(
                "COD_RESERVA"=>NULL,
                "VORIGEN_RESERVA"=>$origenes[$i],
                "VDESTINO_RESERVA"=>$destinos[$i],
                "FIDA_RESERVA"=>$fida[$i],
                "FREGRESO_RESERVA"=>$fregreso[$i],
                "CHOTEL_RESERVA"=>NULL,
                "FINHOTEL_RESERVA "=>NULL,
                "FSALHOTEL_RESERVA"=>NULL,
                "REGPOR_RESERVA"=>"admintest",
                "FREG_RESERVA"=>$dateTime,
                "COD_SOLICITD"=>$numMaxSol
              );

              $this->reserva_model->insertarReserva($dataReserva);

            }

            
          }
          else
          {
            /*$dataReserva = array(
              "COD_RESERVA"=>NULL,
              "VORIGEN_RESERVA"=>$origenes,
              "VDESTINO_RESERVA"=>$destinos,
              "FIDA_RESERVA"=>$fida,
              "FREGRESO_RESERVA"=>$fregreso,
              "CHOTEL_RESERVA"=>,
              "FINHOTEL_RESERVA "=>,
              "FSALHOTEL_RESERVA"=>,
              "REGPOR_RESERVA"=>,
              "FREG_RESERVA"=>,
              "COD_SOLICITD"=>
            );*/
          }


        break;
        case 'hotel':

        break;
        case 'vueloHotel':

        break;

    }

    /*$dataReserva = array(
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
        );*/


    /*for ($i=0; $i < count($origenes) ; $i++) { 
      echo "insert into values(origen=".$origenes[$i].",destino=".$destinos[$i].",fecha ida=".$fida[$i].", fecha regreso = ".$fregreso[$i].");";
    }*/
    
  }
  /*END FUNCTION INSERTAR()*/

  

}
?>
