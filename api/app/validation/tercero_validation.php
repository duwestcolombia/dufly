<?php
namespace App\Validation;

use App\Lib\Response;

class TerceroValidation {
    public static function validate($data, $update = false) {
        $response = new Response();
        
        $key = 'TIPDOC_TERCERO';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            $longValue = strlen($value);

            if($longValue <= 1) {               
                $response->errors[$key][] = 'Este campo no puede contener menos de 2 digitos';
            }
            else if($longValue > 2){
                $response->errors[$key][] = 'Este campo solo debe contener 2 digitos';
            }
            else
            {
                if(is_numeric($value)) {
                    $response->errors[$key][] = 'Este campo no debe ser numerico';
                }
            }
        }

        $key = 'DOC_TERCERO';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(!is_numeric($value)) {
                $response->errors[$key][] = 'Este campo debe ser numerico';
            }
        }        
        
        $key = 'NOM_TERCERO';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            
            if(strlen($value) < 4) {
                $response->errors[$key][] = 'Este campo debe contener como minimo 4 digitos';
            }
        }
       /* $key = 'FNACIMIENTO_TERCERO';
        if(empty($data[$key])) {
            $response->errors[$key][] = 'Este campo es obligatorio';
        } else {
            $value = $data[$key];
            //Convertimos la fecha en un array de tipo ['04', '05', '2017']
            $fecha = explode('/',$value);
            //Verificamos que la fecha tenga dia, mes y año. Y verificamos con checkdate que la fecha exista en el calendario
            if(count($fecha) != 3) {
                $response->errors[$key][] = 'La fecha no es valida, verifique si tiene dia, mes y año';
            }
            else
            {
            	if (!checkdate($fecha[1], $fecha[2], $fecha[0])) {
            		$response->errors[$key][] = 'La fecha no existe en el calendario o no tiene el formato Año-Mes-Dia';
            	}
            }
        }*/
        
        

        $response->setResponse(count($response->errors) === 0);

        return $response;
    }
}