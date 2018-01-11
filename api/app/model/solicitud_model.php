<?php
namespace App\Model;

use App\Lib\Response;

class SolicitudModel
{
    private $db;
    private $table = 'solicitudes';
    private $response;
    
    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function listar($l, $p)
    {
        $data = $this->db->from($this->table)
                         ->limit($l)
                         ->offset($p)
                         ->orderBy('ESTADO_SOLICITUD ASC')
                         ->fetchAll();
        
        $total = $this->db->from($this->table)
                          ->select('COUNT(*) Total')
                          ->fetch()
                          ->Total;
        
        return [
            'data'  => $data,
            'total' => $total
        ];
    }
    public function listarPorEmpleado($cod_empleado)
    {
        return $this->db->from($this->table)
                        ->where('COD_EMPLEADO', $cod_empleado)
                        ->fetchAll();
    }    
    public function obtener($cod_solicitud)
    {
        return $this->db->from($this->table)
                        ->where('COD_SOLICITUD', $cod_solicitud)
                        ->fetch();
    }
    public function registrar($data)
    {

      	$this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    public function actualizar($data, $cod_solicitud)
    {
            
        $this->db->update($this->table, $data, $cod_solicitud)
                    ->execute();
            
        return $this->response->SetResponse(true);
    }
    public function eliminar($cod_solicitud)
    {
        $this->db->deleteFrom($this->table)
                 ->where('COD_SOLICITUD', $cod_solicitud)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
    
}