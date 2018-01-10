<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestionbd extends CI_Controller {
  function __construct(){
      parent::__construct();

  }
  function index(){
  		$dato['titulo']="Gestion BD";

  		$this->load->view('templates/header',$dato);
      	$this->load->view('gestionbd_view');
      	$this->load->view('templates/footer');
  }

}
?>