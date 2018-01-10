<?php
namespace App\Model;

use App\Lib\Response;

class PedidoModel
{
    private $db;
    private $table = 'pedido';
    private $tableTwo = 'pedido_detalle';
    private $response;
    
    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }
    
    public function listarPorEmpleado($empleado_id)
      {
           return  $this->db ->from($this->table)
                              ->where('Empleado_id',$empleado_id)
                              ->innerJoin('tabla_de_tablas ON tabla_de_tablas.Relacion ="pedido_estado" AND tabla_de_tablas.id=pedido.Estado_id')
                             ->select('pedido.*,empleado.Nombre, tabla_de_tablas.Valor')
                             ->orderBy('id DESC')
                             ->fetchAll();
            
      }
    public function listar($l, $p)
    {

        $data = $this->db->from($this->table)
                         ->innerJoin('empleado')
                         ->select('Nombre')
                         ->leftJoin('tabla_de_tablas ON tabla_de_tablas.Relacion ="pedido_estado" AND tabla_de_tablas.id=pedido.Estado_id')
                         ->select('tabla_de_tablas.Valor')
                         ->limit($l)
                         ->offset($p)
                         ->orderBy('id DESC')
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
    public function obtener($id)
    {
      $row = $this->db->from($this->table, $id)
                      ->innerJoin('tabla_de_tablas ON tabla_de_tablas.Relacion ="pedido_estado" AND tabla_de_tablas.id=pedido.Estado_id')
                      ->select('pedido.*,empleado.Nombre, tabla_de_tablas.Valor')
                      ->fetch();

      $row->{'Detalle'} = $this->db->from('pedido_detalle')
                                    ->select('pedido_detalle.*,producto.Nombre Producto')
                                    ->where('pedido_id',$id)
                                    ->fetchAll();
      return $row;
    }
    public function obtenerDetalle($id)
    {
      return $data = $this->db->from($this->tableTwo)
                              ->where('Pedido_id', $id)
                              ->select('producto.Nombre')
                              ->fetchAll();
    }
        
    public function estados()
    {
      return $data = $this->db->from('tabla_de_tablas')
                              ->where('Relacion', 'pedido_estado')
                              ->orderBy('Orden')
                              ->fetchAll();
    }
    public function actualizaEstado($pedido_id, $estado_id)
    {
      $this->db->update($this->table, ['Estado_id'=>$estado_id],$pedido_id)
                      ->execute();
      return $this->response->SetResponse(true);
    }
    public function guardar($data)
    {

        //Primero insertamos el pedido y obtenemos el id
      $pedido_id = $this->db->insertInto($this->table, [
        'Estado_id'=>0,
        'Cliente'=> $data['Cliente'],
        'Empleado_id' =>$data['Empleado_id'],
        'Total'=>$data['Total'],
        'Fecha'=>date('y-m-d')
        ])->execute();

      //Insertamos el detalle del pedido
      foreach ($data['Detalle'] as $d) {
        $this->db->insertInto('pedido_detalle',[
          'Pedido_id'=>$pedido_id,
          'Producto_id'=> $d['Producto_id'],
          'PrecioUnitario' =>$d['PrecioUnitario'],
          'Cantidad'=>$d['Cantidad'],
          'Total'=>$d['Total']
        ])->execute();
      }
      return $this->response->SetResponse(true);
    }
    
    

}