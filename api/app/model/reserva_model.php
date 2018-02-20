<?php
namespace App\Model;

use App\Lib\Response;

class ReservaModel
{
    private $db;
    private $table = 'reservas';
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
                         ->orderBy('COD_RESERVA ASC')
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