<?php
namespace App\Model;

use App\Lib\Response;

class EmpleadoModel
{
    private $db;
    private $table = 'empleados';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
    }

    public function listar($l, $p)
    {
        $data = $this->db->from($this->table)
                         ->select(
                            ' COD_EMPLEADO,
                              EMAIL_EMPLEADO,
                              NOMBRE_EMPLEADO,
                              FNACIMIENTO_EMPLEADO,
                              TEL_EMPLEADO
                            ')
                         ->limit($l)
                         ->offset($p)
                         ->orderBy('COD_EMPLEADO DESC')
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

    public function obtener($COD_EMPLEADO)
    {
      /*return $this->db->from($this->table)
                      ->select(
                          ' jefe.COD_EMPLEADO "COD_JEFE",
                            jefe.NOMBRE_EMPLEADO "NOM_JEFE",
                            jefe.EMAIL_EMPLEADO "EMAIL_JEFE"
                          ')
                      ->innerJoin('empleados jefe on jefe.COD_EMPLEADO = empleados.JEFE_EMPLEADO')
                      ->where('empleados.COD_EMPLEADO', $COD_EMPLEADO)
                      ->fetch();*/
        return $this->db->from($this->table)
                        ->select(
                            ' empleados.COD_EMPLEADO,
                              empleados.EMAIL_EMPLEADO,
                              empleados.NOMBRE_EMPLEADO,
                              empleados.FNACIMIENTO_EMPLEADO,
                              empleados.TEL_EMPLEADO
                            ')
                        ->where('COD_EMPLEADO', $COD_EMPLEADO)
                        ->fetch();
    }
    public function obtenerJefe($COD_EMPLEADO)
    {
    /*  SELECT jefe.COD_EMPLEADO "COD_JEFE", jefe.NOMBRE_EMPLEADO "NOM_JEFE",jefe.EMAIL_EMPLEADO "EMAIL_JEFE"
FROM empleados
inner join empleados jefe on jefe.COD_EMPLEADO = empleados.JEFE_EMPLEADO
where empleados.COD_EMPLEADO = 33001;*/
        return $this->db->from($this->table)
                        ->select(
                            ' jefe.COD_EMPLEADO "COD_JEFE",
                              jefe.NOMBRE_EMPLEADO "NOM_JEFE",
                              jefe.EMAIL_EMPLEADO "EMAIL_JEFE"
                            ')
                        ->innerJoin('empleados jefe on jefe.COD_EMPLEADO = empleados.JEFE_EMPLEADO')
                        ->where('empleados.COD_EMPLEADO', $COD_EMPLEADO)
                        ->fetch();
    }

     public function registrar($data)
    {
        $data['Password'] = md5($data['Password']);

        $this->db->insertInto($this->table, $data)
                 ->execute();

        return $this->response->SetResponse(true);
    }

    public function actualizar($data, $COD_EMPLEADO)
    {
        if(isset($data['PASS_EMPLEADO'])){
            $data['PASS_EMPLEADO'] = md5($data['PASS_EMPLEADO']);
        }

        $this->db->update($this->table, $data)
                 ->where('COD_EMPLEADO', $COD_EMPLEADO)
                 ->execute();

        return $this->response->SetResponse(true);
    }

    public function eliminar($id)
    {
        $this->db->deleteFrom($this->table, $id)
                 ->execute();

        return $this->response->SetResponse(true);
    }
}
