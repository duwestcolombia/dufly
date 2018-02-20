<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\ReservaValidation,
    App\Middleware\AuthMiddleware;

$app->group('/reserva/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->reserva->listar($args['l'], $args['p']))
                   );
    });
    
    $this->get('obtener/{cod_solicitud}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->reserva->obtener($args['cod_solicitud']))
                   );
    });
    $this->post('registrar', function ($req, $res, $args) {

      /*$r = SolicitudValidation::validate($req->getParsedBody());
      
      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));            
      }*/

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->reserva->registrar($req->getParsedBody()))
                   );
    });
    $this->put('actualizar/{cod_solicitud}', function ($req, $res, $args) {
        $r = SolicitudValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));            
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->reserva->actualizar($req->getParsedBody(), $args['cod_solicitud']))
                   );   
    });
     $this->delete('eliminar/{cod_solicitud}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->reserva->eliminar($args['cod_solicitud']))
                   );   
    });
})->add(new AuthMiddleware($app));