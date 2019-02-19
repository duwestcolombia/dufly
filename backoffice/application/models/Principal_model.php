<?php
class Principal_Model extends CI_Model{
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
    public function listarNuevas(){
        //Llamamos a la restApi
        return RestApi::call(
            //le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "solicitud/listarNuevas"
        );
    }
    public function listarPorJefe($cod_empleado){
        //Llamamos a la restApi
        return RestApi::call(
            //le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "solicitud/listarPorJefe/$cod_empleado"
        );
    }
    public function obtener($cod_solicitud){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "solicitud/obtener/$cod_solicitud"
        );
    }
    public function obtenerDeptoCompras(){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::GET,
            "solicitud/obtenerDeptoCompras"
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
    public function actualizar($data,$cod_solicitud){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::PUT,
            "solicitud/actualizar/$cod_solicitud",
            $data
        );
    }
    public function guardar($data,$cod_solicitud){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::PUT,
            "solicitud/guardar/$cod_solicitud",
            $data
        );
    }
    public function liberarSolicitud($data,$cod_solicitud){
        //Llamamos a la restApi
        return RestApi::call(
        	//le mandamos una peticion get a la ruta empleado listar
            RestApiMethod::PUT,
            "solicitud/liberarSolicitud/$cod_solicitud",
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
