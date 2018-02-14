<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
  function __construct(){
      parent::__construct();
     $this->load->model('login_model');

  }
  function index(){

      $dato['titulo']="Login | Dufly";
      //$dato = array('consulta'=>$result);     
      $this->load->view('header',$dato);
      $this->load->view('login/index');
      $this->load->view('footer');

  		
      /*if ($this->session->userdata('user_logueado')) {
        redirect('/index.php/principal','refresh');
  		
      }*/   


  }
  function validaingreso(){
    $error = '';
    $usu = $_POST['txt_usu'];
    $pass = $_POST['txt_pass'];

    $r = $this->login_model->autenticar($usu,$pass);

    if ($r->response) {
      RestApi::setToken($r->result);

      $user = RestApi::getUserData();
      if ($user->ADMIN_EMPLEADO == 1) {
        redirect('principal');
      }
      else
      {
        RestApi::destroyToken();
        $error = "Usted no tiene privilegios de administrador para ingresar en esta aplicación.";
      }
      
    }else{
      $error = $r->message;
    }
    $data['error'] = $r->message;
    $this->load->view('header',$data);
    $this->load->view('login/index');
    $this->load->view('footer');
   
   
    
  }
  function cerrarsesion(){
    RestApi::destroyToken();
    redirect('');

  }

}
?>