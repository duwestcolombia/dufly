<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
  function __construct(){
      parent::__construct();
      $this->user=['user'=>RestApi::getUserData()];

      if ($this->user['user'] === null) {
        redirect('');
      }
     $this->load->model('principal_model');

  }
  function index($p = 0){
  		
    
  		$this->load->view('header',$this->user);
      //Definimos variables para traer data y mantener logica de paginacion
      $limite = 10;
      $data = [];
      $total  = 0;

      try {

        $result = $this->principal_model->listar($limite,$p);
        $total = $result->total;
        $data = $result->data;
        var_dump($data);
      } catch (Exception $e) {
        var_dump($e);
      }

      $this->load->view('solicitud/index');
      $this->load->view('footer');
  }


}

?>