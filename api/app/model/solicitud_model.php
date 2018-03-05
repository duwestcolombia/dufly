<?php
namespace App\Model;

use App\Lib\Response,
    App\Lib\Mail;

class SolicitudModel
{
    private $db;
    private $table = 'solicitudes';
    private $response;

    public function __CONSTRUCT($db)
    {
        $this->db = $db;
        $this->response = new Response();
        $this->mail = new Mail();
    }

    public function listar($l, $p)
    {
        $data = $this->db->from($this->table)
                        ->select(null)->select('
                                solicitudes.COD_SOLICITUD,
                                solicitudes.VUELO_SOLICITUD,
                                solicitudes.VIDAREGRESO_SOLICITUD,
                                solicitudes.HOTEL_SOLICITUD,
                                solicitudes.ESTADO_SOLICITUD,
                                solicitudes.REQTERCERO_SOLICITUD,
                                solicitudes.AUTORIZA_SOLICITUD,
                                solicitudes.LIBERA_SOLICITUD,
                                solicitudes.FREG_SOLICITUD,
                                solicitudes.OBSERVACION_SOLICITUD,
                                solicitudes.OBJETIVO_SOLICITUD,
                                terceros.DOC_TERCERO,
                                terceros.TIPDOC_TERCERO,
                                terceros.NOM_TERCERO,
                                terceros.FNACIMIENTO_TERCERO,
                                terceros.TEL_TERCERO,
                                empleados.NOMBRE_EMPLEADO,
                                empleados.FNACIMIENTO_EMPLEADO,
                                empleados.TEL_EMPLEADO
                            ')
                            ->innerJoin('terceros on solicitudes.DOC_TERCERO = terceros.DOC_TERCERO')
                            ->innerJoin('empleados on solicitudes.COD_EMPLEADO = empleados.COD_EMPLEADO')
                            ->orderBy('FREG_SOLICITUD DESC')
                            ->limit($l)
                            ->offset($p)
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
    public function listarTodos()
    {
        $data = $this->db->from($this->table)
                        ->select(null)->select('
                                solicitudes.COD_SOLICITUD,
                                solicitudes.VUELO_SOLICITUD,
                                solicitudes.VIDAREGRESO_SOLICITUD,
                                solicitudes.HOTEL_SOLICITUD,
                                solicitudes.ESTADO_SOLICITUD,
                                solicitudes.REQTERCERO_SOLICITUD,
                                solicitudes.AUTORIZA_SOLICITUD,
                                solicitudes.LIBERA_SOLICITUD,
                                solicitudes.FREG_SOLICITUD,
                                solicitudes.OBSERVACION_SOLICITUD,
                                solicitudes.OBJETIVO_SOLICITUD,
                                terceros.DOC_TERCERO,
                                terceros.TIPDOC_TERCERO,
                                terceros.NOM_TERCERO,
                                terceros.FNACIMIENTO_TERCERO,
                                terceros.TEL_TERCERO,
                                empleados.NOMBRE_EMPLEADO,
                                empleados.FNACIMIENTO_EMPLEADO,
                                empleados.TEL_EMPLEADO
                            ')
                            ->innerJoin('terceros on solicitudes.DOC_TERCERO = terceros.DOC_TERCERO')
                            ->innerJoin('empleados on solicitudes.COD_EMPLEADO = empleados.COD_EMPLEADO')
                            ->orderBy('FREG_SOLICITUD DESC')

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

    public function listarPorJefe($cod_empleado)
    {
        $data = $this->db->from($this->table)
                        ->select(null)->select('
                                solicitudes.COD_SOLICITUD,
                                solicitudes.VUELO_SOLICITUD,
                                solicitudes.VIDAREGRESO_SOLICITUD,
                                solicitudes.HOTEL_SOLICITUD,
                                solicitudes.ESTADO_SOLICITUD,
                                solicitudes.REQTERCERO_SOLICITUD,
                                solicitudes.AUTORIZA_SOLICITUD,
                                solicitudes.LIBERA_SOLICITUD,
                                solicitudes.FREG_SOLICITUD,
                                solicitudes.OBSERVACION_SOLICITUD,
                                solicitudes.OBJETIVO_SOLICITUD,
                                terceros.DOC_TERCERO,
                                terceros.TIPDOC_TERCERO,
                                terceros.NOM_TERCERO,
                                terceros.FNACIMIENTO_TERCERO,
                                terceros.TEL_TERCERO,
                                empleados.NOMBRE_EMPLEADO,
                                empleados.FNACIMIENTO_EMPLEADO,
                                empleados.TEL_EMPLEADO
                            ')
                            ->innerJoin('terceros on solicitudes.DOC_TERCERO = terceros.DOC_TERCERO')
                            ->innerJoin('empleados on solicitudes.COD_EMPLEADO = empleados.COD_EMPLEADO')
                            ->where('solicitudes.ESTADO_SOLICITUD', 'NUEVA')
                            ->where('empleados.JEFE_EMPLEADO', $cod_empleado)
                            ->orderBy('FREG_SOLICITUD DESC')
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
    public function obtener($COD_SOLICITUD)
    {
      $row =  $this->db->from($this->table)
                        ->select(null)->select('
                                solicitudes.COD_SOLICITUD,
                                solicitudes.VUELO_SOLICITUD,
                                solicitudes.VIDAREGRESO_SOLICITUD,
                                solicitudes.HOTEL_SOLICITUD,
                                solicitudes.ESTADO_SOLICITUD,
                                solicitudes.REQTERCERO_SOLICITUD,
                                solicitudes.OBJETIVO_SOLICITUD,
                                solicitudes.AUTORIZA_SOLICITUD,
                                solicitudes.LIBERA_SOLICITUD,
                                solicitudes.FREG_SOLICITUD,
                                solicitudes.OBSERVACION_SOLICITUD,
                                solicitudes.COD_EMPLEADO,
                                solicitudes.OBJETIVO_SOLICITUD,
                                terceros.DOC_TERCERO,
                                terceros.TIPDOC_TERCERO,
                                terceros.NOM_TERCERO,
                                terceros.FNACIMIENTO_TERCERO,
                                terceros.TEL_TERCERO,
                                empleados.NOMBRE_EMPLEADO,
                                empleados.FNACIMIENTO_EMPLEADO,
                                empleados.TEL_EMPLEADO,
                                empleados.COD_DEPARTAMENTO,
                                jefe.NOMBRE_EMPLEADO "NOM_JEFE",
                                jefe.EMAIL_EMPLEADO "EMAIL_JEFE"
                            ')
                        ->innerJoin('terceros on solicitudes.DOC_TERCERO = terceros.DOC_TERCERO')
                        ->innerJoin('empleados on solicitudes.COD_EMPLEADO = empleados.COD_EMPLEADO')
                        ->innerJoin('empleados jefe on jefe.COD_EMPLEADO = empleados.JEFE_EMPLEADO')
                        ->where('COD_SOLICITUD', $COD_SOLICITUD)
                        ->fetch();
        $row->{'Vuelos'} = $this->db->from('reservas')
                                    ->select(null)->select('
                                            CO.NOMBRE_CIUDAD "CIUD_ORIGEN",
                                            CD.NOMBRE_CIUDAD "CIUD_DESTINO",
                                            reservas.FIDA_RESERVA,
                                            reservas.FREGRESO_RESERVA
                                        ')
                                    ->innerJoin('ciudades as CO on reservas.VORIGEN_RESERVA = CO.ID_CIUDAD')
                                    ->innerJoin('ciudades as CD on reservas.VDESTINO_RESERVA = CD.ID_CIUDAD')
                                    ->innerJoin('solicitudes on reservas.COD_SOLICITUD = solicitudes.COD_SOLICITUD')
                                    ->where('solicitudes.COD_SOLICITUD', $COD_SOLICITUD)
                                    ->fetchAll();
        $row->{'Hoteles'} = $this->db->from('reservas_hoteles')
                                        ->select(null)->select('
                                                CH.NOMBRE_CIUDAD "CIUD_HOTEL",
                                                reservas_hoteles.FINHOTEL_RESERVA,
                                                reservas_hoteles.FSALHOTEL_RESERVA
                                            ')
                                        ->innerJoin('ciudades as CH on reservas_hoteles.CHOTEL_RESERVA = CH.ID_CIUDAD')
                                        ->innerJoin('solicitudes on reservas_hoteles.COD_SOLICITUD = solicitudes.COD_SOLICITUD')
                                        ->where('solicitudes.COD_SOLICITUD', $COD_SOLICITUD)
                                        ->fetchAll();

        return $row;


    }

    public function obtenerDeptoCompras()
    {
      /*el doble select se usa para regresar solo los valores indicados*/
      return $this->db->from('empleados')
                      ->select(null)->select('
                        empleados.EMAIL_EMPLEADO,
                        empleados.NOMBRE_EMPLEADO
                      ')
                        ->where('COD_DEPARTAMENTO', '2')
                        ->fetchAll();
    }

    public function registrar($data)
    {
        $dateTime=date('Y/m/d h:i:s', time());
        $mailEMp = '';
        $objSol = '';
        $nomEmp = '';
        try {
            foreach ($data['Op'] as $opcion) {
              /*Declara variables para enviar correo*/
              $mailEMp = $opcion['MAIL_EMPLEADO'];
              $objSol = $opcion['OBJETIVO_SOLICITUD'];
              $nomEmp = $opcion['NOM_EMPLEADO'];
              $mailJefe = $opcion['MAIL_JEFE'];
            /*Inicia el registro de la informacion en la base de datos*/
          $solicitud_id = $this->db->insertInto($this->table, [
                  'VUELO_SOLICITUD'=> $opcion['SVUELO'],
                  'VIDAREGRESO_SOLICITUD' => $opcion['SVIDA_REGRESO'],
                  'HOTEL_SOLICITUD' => $opcion['SHOTEL'],
                  'REQTERCERO_SOLICITUD' => $opcion['STERCERO'],
                  'DOC_TERCERO' => $opcion['DOC_TERCERO'],
                  'TIPDOC_TERCERO' => $opcion['TIPDOC_TERCERO'],
                  'OBSERVACION_SOLICITUD' => '',
                  'AUTORIZA_SOLICITUD' => '',
                  'LIBERA_SOLICITUD'=>'',
                  'REGPOR_SOLICITUD' => $opcion['COD_EMPLEADO'],
                  'FREG_SOLICITUD' => $dateTime,
                  'COD_EMPLEADO' => $data['COD_EMPLEADO'],
                  'ESTADO_SOLICITUD' => 'NUEVA',
                  'OBJETIVO_SOLICITUD' => $opcion['OBJETIVO_SOLICITUD']

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
                      'COD_SOLICITUD' => $solicitud_id
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
                      'COD_SOLICITUD' => $solicitud_id
                  ])->execute();
              }
          }

          /*DATA MAIL*/
            $datos = [
              'to'=>$mailEMp,
              'cc'=>'',
              'bcc'=>$mailJefe,
              'subject'=>'Dufly - Registro Solicitud #: '.$solicitud_id.' de vuelos y/o hoteles',
              'message'=>'
                <strong>Solicitud #</strong>: '.$solicitud_id.' de vuelo y/o hotel,  ya puedes consultar toda la informacion en la aplicacion web <a target="_blank" href="http://dufly.duwestcolombia.com">Dufly - DuwestColombia</a>
                <br>
                <hr>
                <h3>Informacion de la solicitud</h3>
                <br>
                <strong>Solicitante:</strong> '.$nomEmp.'
                <br>
                <strong>Objetivo de la solicitud:</strong> '.$objSol.'
                  '
            ];

          /*EN DATA MAIL*/

          $responseMail = $this->enviarCorreo($datos);

          if ($responseMail) {

            return $this->response->SetResponse(true, $responseMail);
          }
          else {
            return $this->response->SetResponse(false, "No se envio el correo, la solicitud se almaceno de todas formas.");
          }



        } catch (Exception $e) {

          return $this->response->SetResponse(false, "Se presento un error al registrar su solicitud. ".$e);
        }

    }

    public function enviarCorreo($datos)
    {
      //sendMail($to,$cc,$subject,$message)
      return $this->mail->sendMail($datos['to'],$datos['cc'],$datos['bcc'],$datos['subject'] ,$datos['message']);
    }

    public function actualizar($data, $cod_solicitud)
    {

        /*DATA MAIL*/
            $datos = [
              'to'=>'',
              'cc'=>'',
              'bcc'=>'',
              'subject'=>'Dufly - Solicitud Autorizada #: '.$cod_solicitud.' de vuelos y/o hoteles',
              'message'=>'
                <strong>Solicitud #</strong>: '.$cod_solicitud.' de vuelo y/o hotel se encuentra autorizada y lista para ser liberada.
                <br>
                <hr>
              '
            ];

          /*EN DATA MAIL*/
          $this->db->update($this->table, $data)
                      ->where('COD_SOLICITUD',$cod_solicitud)
                      ->execute();

        $mailCompras = $this->obtenerDeptoCompras();

        $responseMail = '';

        foreach ($mailCompras as $mc) {
          $datos['to'] = $mc->EMAIL_EMPLEADO;
          $responseMail = $this->enviarCorreo($datos);
        }

        if ($responseMail) {

            return $this->response->SetResponse(true, $responseMail);
          }
          else {
            return $this->response->SetResponse(false, "No se envio el correo, la solicitud se almaceno de todas formas.");
          }


        //return $this->response->SetResponse(true);
    }
    public function eliminar($cod_solicitud)
    {
        $this->db->deleteFrom($this->table)
                 ->where('COD_SOLICITUD', $cod_solicitud)
                 ->execute();

        return $this->response->SetResponse(true);
    }

}
