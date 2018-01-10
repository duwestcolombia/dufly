<?php
namespace App\Validation;

use App\Lib\Response;

class PedidoValidation {
    public static function validate($data) {
        $response = new Response();
        
        $key = 'Cliente';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 10) {
                $response->errors[$key][] = 'Debe contener como mínimo 10 caracteres';
            }
        }
        $key = 'Empleado_id';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(!is_numeric($value)) {
                $response->errors[$key][] = 'El campo ingresado no es un id valido';
            }
        }
        $key = 'Total';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(!is_numeric($value)) {
                $response->errors[$key][] = 'El precio ingresado no es válido';
            }
        }
        $key = 'Detalle';
        if(!isset($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';

        } else if(!is_array($data[$key])) {

             $response->errors[$key][] = 'El detalle ingresado no es válido';
        }
        else {
            $value = $data[$key];
            
            if(count($value) === 0) {
                $response->errors[$key][] = 'No ingreso un detalle correcto';
            }
        }
        
        
        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}