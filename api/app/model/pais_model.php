<?php
namespace App\Model;

use App\Lib\Response;

class PaisModel
{
    private $db;
    private $table = 'paises';
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
                         ->orderBy('NOMBRE_PAIS ASC')
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
    
    public function obtener($id_pais)
    {
        return $this->db->from($this->table)
                        ->where('ID_PAIS', $id_pais)
                        ->fetch();
    }
    
    public function registrar($data)
    {
        $this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    public function actualizar($data, $id_pais)
    {
            
        $this->db->update($this->table, $data, $id_pais)
                    ->execute();
            
        return $this->response->SetResponse(true);
    }
    public function eliminar($id_pais)
    {
        $this->db->deleteFrom($this->table)
                 ->where('ID_PAIS', $id_pais)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
    
}