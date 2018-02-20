<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\PaisValidation,
    App\Middleware\AuthMiddleware;

$app->group('/pais/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->pais->listar($args['l'], $args['p']))
                   );
    });
    
    $this->get('obtener/{id_pais}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->pais->obtener($args['id_pais']))
                   );
    });
    $this->post('registrar', function ($req, $res, $args) {

      $r = PaisValidation::validate($req->getParsedBody());
      
      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));            
      }

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->pais->registrar($req->getParsedBody()))
                   );
    });
    $this->put('actualizar/{id_pais}', function ($req, $res, $args) {
        $r = PaisValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));            
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->pais->actualizar($req->getParsedBody(), $args['id_pais']))
                   );   
    });
     $this->delete('eliminar/{id_pais}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->pais->eliminar($args['id_pais']))
                   );   
    });
})->add(new AuthMiddleware($app));