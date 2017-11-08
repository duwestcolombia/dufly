<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Misreservas extends CI_Controller {
  function __construct(){
      parent::__construct();
      $this->load->model('misreservas_model');

  }
  function index(){
  		
  		$dato['titulo']="Mis reservas";
      //$dato = array('consulta'=>$result);     
  		$this->load->view('templates/header',$dato);

      $resultVuelos = $this->misreservas_model->getReservasVuelos();
      $resultHoteles = $this->misreservas_model->getReservasHoteles();
      $data = array(
        'vuelos'=>$resultVuelos,
        'hoteles'=>$resultHoteles
        );

      $this->load->view('misreservas_view',$data);
      $this->load->view('templates/footer');
  }

}
?>