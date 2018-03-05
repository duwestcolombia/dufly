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
      $datos['data'] = $dataEmp;

      $this->load->view('empleado/index',$datos);
      $this->load->view('footer');
  }
  function actualizar(){

  }
  function guardar(){
    $errors = [];

    $cod_solicitud = $this->input->post('txt_codsolicitud');

    $data = [
      'OBSERVACION_SOLICITUD'=>$this->input->post('txt_observacion')
    ];

    try {

      $this->principal_model->actualizar($data, $cod_solicitud);

    } catch (Exception $e) {

      if ($e->getMessage() === RestApiErrorCode::UNPROCESSABLE_ENTITY) {

          $errors = RestApi::getEntityValidationFieldsError();
          var_dump($errors);


      }

    }
    if (count($errors)=== 0)redirect('principal');
    else
    {
        var_dump($errors);
        /*$this->load->view('header', $this->user);
        $this->load->view('empleado/validation', ['errors' => $errors]);
        $this->load->view('footer');*/
    }


  }



}

?>
