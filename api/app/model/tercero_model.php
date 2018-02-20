<?php
namespace App\Model;

use App\Lib\Response;

class TerceroModel
{
    private $db;
    private $table = 'terceros';
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
                         ->orderBy('NOM_TERCERO ASC')
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
    
    public function obtener($doc_tercero)
    {
        return $this->db->from($this->table)
                        ->where('DOC_TERCERO', $doc_tercero)
                        ->fetch();
    }
    public function obtenerTodos()
    {
        return $this->db->from($this->table)
                        ->fetchAll();
    }

    public function coincidir($nom_tercero)
    {
        return $this->db->from($this->table)
                        ->where('(NOM_TERCERO LIKE ?)','%'.$nom_tercero.'%')
                        ->fetchAll();
    }
    
    public function registrar($data)
    {
        $dateTime=date('Y/m/d h:i:s', time());

        $data['FREG_TERCERO'] = $dateTime;

      	$this->db->insertInto($this->table, $data)
                 ->execute();
        
        return $this->response->SetResponse(true);
    }
    public function actualizar($data, $doc_tercero,$tdoc_tercero)
    {
            
        $this->db->update($this->table, $data, $doc_tercero,$$tdoc_tercero)
                    ->execute();
            
        return $this->response->SetResponse(true);
    }
    public function eliminar($doc_tercero,$tdoc_tercero)
    {
        $this->db->deleteFrom($this->table)
                 ->where('DOC_TERCERO', $doc_tercero)
                 ->where('TIPDOC_TERCERO', $tdoc_tercero)
                 ->execute();
        
        return $this->response->SetResponse(true);
    } 
    
}