<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\EmpleadoValidation,
    App\Middleware\AuthMiddleware;

$app->group('/empleado/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->empleado->listar($args['l'], $args['p']))
                   );
    });
    
    $this->get('obtener/{COD_EMPLEADO}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->empleado->obtener($args['COD_EMPLEADO']))
                   );
    });
    
    $this->post('registrar', function ($req, $res, $args) {

      $r = EmpleadoValidation::validate($req->getParsedBody());
      
      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));            
      }

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->empleado->registrar($req->getParsedBody()))
                   );
    });
    
    $this->put('actualizar/{COD_EMPLEADO}', function ($req, $res, $args) {
        $r = EmpleadoValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));            
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->empleado->actualizar($req->getParsedBody(), $args['COD_EMPLEADO']))
                   );   
    });
    
    $this->delete('eliminar/{id}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->empleado->eliminar($args['id']))
                   );   
    });
})->add(new AuthMiddleware($app));