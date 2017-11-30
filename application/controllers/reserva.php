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
    
    
  }
  /*END FUNCTION INSERTAR()*/

  

}
?>
