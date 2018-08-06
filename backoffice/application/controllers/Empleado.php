<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado extends CI_Controller {
  private $user;

  function __construct(){
      parent::__construct();
      $this->user=['user'=>RestApi::getUserData()];

      try {
        if ($this->user['user'] === null) {

          redirect('');

        }
      } catch (Exception $e) {
        var_dump($e);
      }

     $this->load->model('empleado_model');

  }
  function index(){

  		$this->load->view('header',$this->user);

      foreach ($this->user as $ruser) {
        $COD_EMPLEADO = $ruser->COD_EMPLEADO;
      }

      $dataEmp = $this->empleado_model->obtener($COD_EMPLEADO);
      $dataEmp->PASS_EMPLEADO = ':)';
      $datos['data'] = $dataEmp;

      $this->load->view('empleado/index',$datos);
      $this->load->view('footer');
  }
  function actualizar(){
    $errors = [];

    $pass = $this->input->post('txt_pass');
    $pass2 = $this->input->post('txt_passConfig');

    if ($pass === $pass2) {

      if ($pass <> '') {
        $data = [
          'NOMBRE_EMPLEADO' => $this->input->post('txt_nomempleado'),
          'EMAIL_EMPLEADO' => $this->input->post('txt_email'),
          'TEL_EMPLEADO'=> $this->input->post('txt_telefono'),
          'FNACIMIENTO_EMPLEADO'=>$this->input->post('txt_fnacimiento'),  
          'PASS_EMPLEADO' => $pass
        ];
      }else{

        $data = [
          'NOMBRE_EMPLEADO' => $this->input->post('txt_nomempleado'),
          'EMAIL_EMPLEADO' => $this->input->post('txt_email'),
          'TEL_EMPLEADO'=> $this->input->post('txt_telefono'),
          'FNACIMIENTO_EMPLEADO'=>$this->input->post('txt_fnacimiento'), 
        ];
      }


      try {
        $usuario = $this->user['user']->COD_EMPLEADO;

     
        $resp =  $this->empleado_model->actualizar($usuario, $data);


      }catch (Exception $e){
          if ($e->getMessage() === RestApiErrorCode::UNPROCESSABLE_ENTITY) {

            $errors = RestApi::getEntityValidationFieldsError();
            var_dump($errors);


          }
      }

      if (count($errors)=== 0)redirect('empleado');

      
    }else{
      echo '<script>alert("Las contraseñas no coinciden");</script>';
      $this->index();
    }


  }




}

?>
