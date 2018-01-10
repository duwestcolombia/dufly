<?php
namespace App\Validation;

use App\Lib\Response;

class ProductoValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'Nombre';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Debe contener como mínimo 4 caracteres';
            }
        }
        
        $key = 'Precio';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(filter_var($value,FILTER_VALIDATE_INT)) {
                $response->errors[$key][] = 'Este campo debe contener decimales, si el producto no contiene valor con decimales agregar (,00) despues del valor del producto.';
            }
        }
        
        

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}