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
                        ->orderBy('ESTADO_SOLICITUD DESC')
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
        $dateTime=date('Y/m/d h:i:s', time());

        foreach ($data['Op'] as $opcion) {

            $solicitud_id = $this->db->insertInto($this->table, [
                'VUELO_SOLICITUD'=> $opcion['SVUELO'],
                'VIDAREGRESO_SOLICITUD' => $opcion['SVIDA_REGRESO'],
                'HOTEL_SOLICITUD' => $opcion['SHOTEL'],
                'DOC_TERCERO' => '10853147',
                'TIPDOC_TERCERO' => 'CC',
                'OBSERVACION_SOLICITUD' => '',
                'AUTORIZA_SOLICITUD' => '',
                'REGPOR_SOLICITUD' => $opcion['COD_EMPLEADO'],
                'FREG_SOLICITUD' => $dateTime,
                'COD_EMPLEADO' => $data['COD_EMPLEADO'],
                'ESTADO_SOLICITUD' => 'NUEVA'

            ])->execute();
        }

        if (count($data['Reservas'])>0) {

            foreach ($data['Reservas'] as $rVuelo){
                $this->db->insertInto('reservas', [
                    'VORIGEN_RESERVA' => $rVuelo['IDCIUDAD_ORIGEN'],
                    'VDESTINO_RESERVA' => $rVuelo['IDCIUDAD_DESTINO'],
                    'FIDA_RESERVA' => $rVuelo['FECHA_SALIDA'],
                    'FREGRESO_RESERVA' => $rVuelo['FECHA_REGRESO'],
                    'REGPOR_RESERVA' => $data['COD_EMPLEADO'],
                    'FREG_RESERVA' => $dateTime,
                    'COD_SOLICITD' => $solicitud_id
                ])->execute();
            }
        }

        if (count($data['Hoteles'])>0) {
            foreach ($data['Hoteles'] as $rHotel){
                $this->db->insertInto('reservas_hoteles', [
                    'CHOTEL_RESERVA' => $rHotel['ID_CIUDADH'],
                    'FINHOTEL_RESERVA' => $rHotel['FINGRESO_HOTEL'],
                    'FSALHOTEL_RESERVA' => $rHotel['FSAL_HOTEL'],
                    'REGPOR_RESERVA' => $data['COD_EMPLEADO'],
                    'FREG_RESERVA' => $dateTime,
                    'COD_SOLICITD' => $solicitud_id
                ])->execute();
            }
        }
        
    
      	//$this->db->insertInto($this->table, $data)
          //       ->execute();
        
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