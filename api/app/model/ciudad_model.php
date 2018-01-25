<?php
namespace App\Model;

use App\Lib\Response;

class CiudadModel
{
    private $db;
    private $table = 'ciudades';
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
                         ->orderBy('NOMBRE_CIUDAD ASC')
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
    
    public function todos()
    {
        return $this->db->from($this->table)
                        ->orderBy('NOMBRE_CIUDAD ASC')
                        ->fetchAll();
    }

    public function obtener($id_ciudad)
    {
        return $this->db->from($this->table)
                        ->where('ID_CIUDAD', $id_ciudad)
                        ->fetch();
    }
    
    public function registrar($data)
    {
        $this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    public function actualizar($data, $id)
    {
            
        $this->db->update($this->table, $data, $id)
                    ->execute();
            
        return $this->response->SetResponse(true);
    }
    public function eliminar($id_ciudad)
    {
        $this->db->deleteFrom($this->table)
                 ->where('ID_CIUDAD', $id_ciudad)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
    
}