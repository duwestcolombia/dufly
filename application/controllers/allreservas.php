<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Allreservas extends CI_Controller {
  function __construct(){
      parent::__construct();
      $this->load->model('allreservas_model');
  }
  function index(){
  		$dato['titulo']="Todas las reservas";
  		$idreserva = 87;

  		$resultReservas = $this->allreservas_model->getAllReservas();
  		$resulVuelo = $this->allreservas_model->consigueInfoReserva($idreserva);
  		$data = array(
  		  'reservas'=>$resultReservas,
  		  'resulVuelo'=>$resulVuelo
  		);

  		$this->load->view('templates/header',$dato);
      	$this->load->view('allreservas_view',$data);
      	$this->load->view('templates/footer');
  }

}
?>