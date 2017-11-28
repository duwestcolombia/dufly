<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
  function __construct(){
      parent::__construct();
     

  }
  function index(){
  		
  		$dato['titulo']="Principal | Dufly";
      //$dato = array('consulta'=>$result);     
  		$this->load->view('templates/header',$dato);
      $this->load->view('home_page');
      $this->load->view('templates/footer');
  }


}

?>