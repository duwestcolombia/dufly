<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Repgastos extends CI_Controller {
  function __construct(){
      parent::__construct();

  }
  function index(){
  		$dato['titulo']="Reporte Gastos";

  		$this->load->view('templates/header',$dato);
      	$this->load->view('repgastos_view');
      	$this->load->view('templates/footer');
  }

}
?>
