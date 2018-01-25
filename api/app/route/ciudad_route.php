<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\CiudadValidation,
    App\Middleware\AuthMiddleware;

$app->group('/ciudad/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->ciudad->listar($args['l'], $args['p']))
                   );
    });
    
    $this->get('obtener/{id_ciudad}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->ciudad->obtener($args['id_ciudad']))
                   );
    });
    $this->get('todos', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->ciudad->todos())
                   );
    });
    $this->post('registrar', function ($req, $res, $args) {

      $r = CiudadValidation::validate($req->getParsedBody());
      
      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));            
      }

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->ciudad->registrar($req->getParsedBody()))
                   );
    });
    $this->put('actualizar/{id_ciudad}', function ($req, $res, $args) {
        $r = CiudadValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));            
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->ciudad->actualizar($req->getParsedBody(), $args['id_ciudad']))
                   );   
    });
     $this->delete('eliminar/{id_ciudad}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->ciudad->eliminar($args['id_ciudad']))
                   );   
    });
})->add(new AuthMiddleware($app));