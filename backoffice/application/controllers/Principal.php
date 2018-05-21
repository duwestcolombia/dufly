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
        foreach ($this->user as $usu) {
          $cod_empleado = $usu->COD_EMPLEADO;
          $depto = $usu->COD_DEPARTAMENTO;
        }

        if ($depto == '2' || $depto == '3') {
            $result = $this->principal_model->listarTodos();
            $total = $result->total;
            $data = $result->data;
        }
        else {
            $result = $this->principal_model->listarPorJefe($cod_empleado);
            $total = $result->total;
            $data = $result->data;
        }



        //var_dump($data);
      } catch (Exception $e) {
        var_dump($e);
      }

      $datos['result']=$data;

      $this->load->view('solicitud/index',$datos);
      $this->load->view('footer');
  }
  function todas(){

    foreach ($this->user as $usu) {
      $depto = $usu->COD_DEPARTAMENTO;
    }

    if ($depto == '2' || $depto == '3') {
        $this->load->view('header',$this->user);
        /**
         * Definimos variables para traer data y mantener logica de paginacion
         */
        $limite = 10;
        $data = [];
        $total  = 0;

        try {

          $result = $this->principal_model->listarTodos();
          $total = $result->total;
          $data = $result->data;

        } catch (Exception $e) {
          var_dump($e);
        }

        $datos['result']=$data;

        $this->load->view('solicitud/todas',$datos);
        $this->load->view('footer');
    }else{
      redirect('principal/');
    }


  }
  function visualizar($cod_solicitud = 0){
    $res = null;
    if ($cod_solicitud>0) {
      $res = $this->principal_model->obtener($cod_solicitud);
      
      $resdos = $this->principal_model->obtenerDeptoCompras($cod_solicitud);


    }


    $this->load->view('header',$this->user);
    $this->load->view('solicitud/visualizar',['data'=>$res]);

    $this->load->view('footer');


  }
  function autorizar($cod_solicitud = 0){
    $errors = [];

      foreach ($this->user as $usu) {
          $nom_empleado = $usu->NOMBRE_EMPLEADO;
      }

    $data = [
      'AUTORIZA_SOLICITUD'=> $nom_empleado,
      'ESTADO_SOLICITUD'=>'PENDIENTE'
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
  function rechazar($cod_solicitud = 0){
    $errors = [];

    foreach ($this->user as $usu) {
          $nom_empleado = $usu->NOMBRE_EMPLEADO;
        }


    //$cod_solicitud = $this->input->post('txt_codsolicitud');

    $data = [
      'AUTORIZA_SOLICITUD'=> $nom_empleado,
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
  function liberar($cod_solicitud = 0){
    /**
     * Inicializamos variables a utilizar
     */
    $errors = [];
    $datamsg=[];
    $nompasajero = "";
    $docpasajero = "";

    foreach ($this->user as $usu) {
          $cod_emp = $usu->COD_EMPLEADO;
          $nom_empleado = $usu->NOMBRE_EMPLEADO;
        }

    $res = $this->principal_model->obtener($cod_solicitud);


    /**
     * Evaluamos si la solicitud que vamos a liberar es para un tercero o es para un empleado ,
     * Si el doc_tercero es 1 esto nos indica que la persona que va a viajar es un empleado, por lo tal capturamos los datos de el
     */
    if ($res->DOC_TERCERO == 1) {
      $nompasajero = $res->NOMBRE_EMPLEADO;
      $tdocpasajero = $res->TIPDOC_EMPLEADO;
      $docpasajero = $res->DOC_EMPLEADO;

    }
    else {
      $nompasajero = $res->NOM_TERCERO;
      $tdocpasajero = $res->TIPDOC_TERCERO;
      $docpasajero = $res->DOC_TERCERO;

    }

    /**
     * Llenamos el arreglo con la informacion que vamos a pasar a la funcion enviar del API
     */

    $data = [
      'LIBERA_SOLICITUD'=> $nom_empleado,
      'nompasajero'=>$nompasajero,
      'tipdocpasajero' =>$tdocpasajero,
      'docpasajero' => $docpasajero,
      'datosvuelo' => $res->Vuelos
    ];

    /**
     * Enviamos el arreglo a la funcion liberar para su tratamiento
     */
    $requestMessage = $this->principal_model->liberarSolicitud($data, $cod_solicitud);

    if ($requestMessage->response === true ) {
        $this->load->view('header', $this->user);
        $this->load->view('solicitud/message', ['message' => $requestMessage->message]);
        $this->load->view('footer');
      //var_dump($requestMessage->message);
    }
    else {
      $this->load->view('header', $this->user);
      $this->load->view('solicitud/message', ['message' => $requestMessage->message]);
      $this->load->view('footer');
      //var_dump($requestMessage->message );
    }

  /*  try {

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
        $this->load->view('empleado/validation', ['errors' => $erors]);
        $this->load->view('footer');*/
    //}

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
