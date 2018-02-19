<?php
namespace App\Validation;

use App\Lib\Response;

class PaisValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'ID_PAIS';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(!is_numeric($value)) {
                $response->errors[$key][] = 'Este campo debe ser numerico';
            }
        }
        
        $key = 'NOMBRE_PAIS';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Este campo debe contener como minimo 4 digitos';
            }
        }
        
        

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}