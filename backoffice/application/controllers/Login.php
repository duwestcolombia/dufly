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
      $this->load->view('templates/header_login',$dato);
      $this->load->view('login_view');
      $this->load->view('templates/footer_login');

  		
      if ($this->session->userdata('user_logueado')) {
        redirect('/index.php/principal','refresh');
  		
      }

   


  }
  function validaingreso(){
   
    $usu = $_POST['txt_usu'];
    $pass = md5($_POST['txt_pass']);

    $usuEncontrado = $this->login_model->getUsusario($usu,$pass);
    
    if ($usuEncontrado) {
      /*strtoupper = CONVIERTE TODO EL TEXTO A MAYUSCULAS*/

        $data = array(
          'user_logueado' => TRUE,
          'name_usuario' => $usuEncontrado->email_usuario,
          'tipo_usuario' => $usuEncontrado->tipo_usuario,

        );
        $this->session->set_userdata($data);
        
        redirect('/index.php/principal','refresh');
      }
      else
      {
        echo '<script>alert("Lo sentimos, el usuario no se encuentra en nuestro sistema. Para mas información comuniquese con el administrador."); </script>';
        $this->index();
      }
   
   
    
  }
  function cerrarsesion(){
    $this->session->sess_destroy();
    redirect('/index.php/inicio','refresh');
  }

}
?>