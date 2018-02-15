<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Principal extends CI_Controller {
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
      
     $this->load->model('principal_model');

  }
  function index($p = 0){
  		
    
  		$this->load->view('header',$this->user);
      //Definimos variables para traer data y mantener logica de paginacion
      $limite = 10;
      $data = [];
      $total  = 0;

      try {

        $result = $this->principal_model->listarTodos();
        $total = $result->total;
        $data = $result->data;
        //var_dump($data);
      } catch (Exception $e) {
        var_dump($e);
      }

      //inicializarla paginacion
      /*$this->pagination->initialize(
        paginacion_config(
          site_url("principal/index"),
          $total,
          $limite
        )
      );*/
      $datos['result']=$data;

      $this->load->view('solicitud/index',$datos);
      $this->load->view('footer');
  }

  function visualizar($cod_solicitud = 0){
    $res = null;
    if ($cod_solicitud>0) {
      $res = $this->principal_model->obtener($cod_solicitud);

    }
    $this->load->view('header',$this->user);
    $this->load->view('solicitud/visualizar',['data'=>$res]);
    $this->load->view('footer');


  }
  function autorizar($cod_solicitud = 0){
    $errors = [];

    //$cod_solicitud = $this->input->post('txt_codsolicitud');

    $data = [
      'ESTADO_SOLICITUD'=>'AUTORIZADA'
    ];

    try {

      if ($cod_solicitud>0) {
       $this->principal_model->actualizar($data, $cod_solicitud);# code...
      }
      
      
    } catch (Exception $e) {
      
      if ($e->getMessage() === RestApiErrorCode::UNPROCESSABLE_ENTITY) {
          
          $errors = RestApi::getEntityValidationFieldsError();
          

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
  function rechazar($cod_solicitud = 0){
    $errors = [];

    //$cod_solicitud = $this->input->post('txt_codsolicitud');

    $data = [
      'ESTADO_SOLICITUD'=>'RECHAZADA'
    ];

    try {

      if ($cod_solicitud>0) {
       $this->principal_model->actualizar($data, $cod_solicitud);
      }
      
      
    } catch (Exception $e) {
      
      if ($e->getMessage() === RestApiErrorCode::UNPROCESSABLE_ENTITY) {
          
          $errors = RestApi::getEntityValidationFieldsError();
          

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