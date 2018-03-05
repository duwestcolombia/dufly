<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\SolicitudValidation,
    App\Middleware\AuthMiddleware;

$app->group('/solicitud/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->listar($args['l'], $args['p']))
                   );
    });
    $this->get('listarTodos', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->listarTodos())
                   );
    });

    $this->get('listarPorJefe/{cod_empleado}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->listarPorJefe($args['cod_empleado']))
                   );
    });
    $this->get('listarPorEmpleado/{cod_empleado}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->listarPorEmpleado($args['cod_empleado']))
                   );
    });
    $this->get('obtener/{COD_SOLICITUD}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->obtener($args['COD_SOLICITUD']))
                   );
    });
        $this->get('obtenerDeptoCompras', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->obtenerDeptoCompras())
                   );
    });
    $this->post('registrar', function ($req, $res, $args) {

      $r = SolicitudValidation::validate($req->getParsedBody());

      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));
      }

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->solicitud->registrar($req->getParsedBody()))
                   );
    });
   $this->post('enviarCorreo', function ($req, $res, $args) {

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->solicitud->enviarCorreo($req->getParsedBody()))
                   );
    });
    $this->put('actualizar/{cod_solicitud}', function ($req, $res, $args) {
        /*$r = SolicitudValidation::validate($req->getParsedBody(), true);

        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));
        }
        */
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->actualizar($req->getParsedBody(), $args['cod_solicitud']))
                   );
    });
     $this->delete('eliminar/{cod_solicitud}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->solicitud->eliminar($args['cod_solicitud']))
                   );
    });
})->add(new AuthMiddleware($app));
