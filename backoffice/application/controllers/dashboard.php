<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
  function __construct(){
      parent::__construct();

  }
  function index(){
  		$dato['titulo']="Dashboard";

  		$this->load->view('templates/header',$dato);
      	$this->load->view('dashboard_view');
      	$this->load->view('templates/footer');
  }

}
?>
