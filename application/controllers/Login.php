<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  function __construct(){
      parent::__construct();
     /* $this->load->model('misreservas_model');*/

  }
  function index(){
  		
  		$dato['titulo']="Login | Dufly";
      //$dato = array('consulta'=>$result);     
  		$this->load->view('templates/header_login',$dato);
      $this->load->view('login_view');
      $this->load->view('templates/footer_login');
  }

}
?>