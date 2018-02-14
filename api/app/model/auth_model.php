<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Auth;

class AuthModel
{
    private $db;
    private $table = 'empleados';
    private $response;
    
    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function autenticar($correo, $password) {
        $empleado = $this->db->from($this->table)
                             ->where('EMAIL_EMPLEADO', $correo)
                             ->where('PASS_EMPLEADO', md5($password))
                             ->fetch();
        
        if(is_object($empleado)){
            
            //$nombre = explode(' ', $empleado->NOMBRE_EMPLEADO)[0];
            $nombre = $empleado->NOMBRE_EMPLEADO;
            $token = Auth::SignIn([
                'COD_EMPLEADO' => $empleado->COD_EMPLEADO,
                'NOMBRE_EMPLEADO' => $nombre,
                'ADMIN_EMPLEADO'=>$empleado->ADMIN_EMPLEADO
                //'EsAdmin' => (bool)$empleado->EsAdmin
            ]);
            
            $this->response->result = $token;
            
            return $this->response->SetResponse(true);
        }else{
            return $this->response->SetResponse(false, "Credenciales no válidas");
        }
    }
}