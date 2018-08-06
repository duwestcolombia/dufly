<?php
class Empleado_Model extends CI_Model{
    public function listar($l = 10, $p = 0){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "solicitud/listar/$l/$p"
        );
    }
    public function listarTodos(){
        //Llamamos a la restApi
        return RestApi::call(
            //le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "solicitud/listarTodos"
        );
    }

    public function obtener($COD_EMPLEADO){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "empleado/obtener/$COD_EMPLEADO"
        );
    }
    public function obtenerJefe($COD_EMPLEADO){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "empleado/obtenerJefe/$COD_EMPLEADO"
        );
    }
    public function registrar($data){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::POST,
            "empleado/registrar",
            $data
        );
    }
    public function actualizar($COD_EMPLEADO,$data){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion put a la ruta empleado actualizar
            RestApiMethod::PUT,
            "empleado/actualizar/$COD_EMPLEADO",
            $data
        );
    }
    public function eliminar($id){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::DELETE,
            "empleado/eliminar/$id"
        );
    }

}
