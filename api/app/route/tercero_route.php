<?php
use App\Lib\Auth,
    App\Lib\Response,
    App\Validation\TerceroValidation,
    App\Middleware\AuthMiddleware;

$app->group('/tercero/', function () {
    $this->get('listar/{l}/{p}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->tercero->listar($args['l'], $args['p']))
                   );
    });
    
    $this->get('obtener/{doc_tercero}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->tercero->obtener($args['doc_tercero']))
                   );
    });
    $this->get('coincidir/{nom_tercero}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->tercero->coincidir($args['nom_tercero']))
                   );
    });
    $this->post('registrar', function ($req, $res, $args) {

      $r = TerceroValidation::validate($req->getParsedBody());
      
      if(!$r->response){
          return $res->withHeader('Content-type', 'application/json')
                     ->withStatus(422)
                     ->write(json_encode($r->errors));            
      }

       return $res->withHeader('Content-type', 'application/json')
                   ->write(
                      json_encode($this->model->tercero->registrar($req->getParsedBody()))
                   );
    });
    $this->put('actualizar/{doc_tercero}/{tdoc_tercero}', function ($req, $res, $args) {
        $r = TerceroValidation::validate($req->getParsedBody(), true);
        
        if(!$r->response){
            return $res->withHeader('Content-type', 'application/json')
                       ->withStatus(422)
                       ->write(json_encode($r->errors));            
        }
        
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->tercero->actualizar($req->getParsedBody(), $args['doc_tercero'],$args['tdoc_tercero']))
                   );   
    });
     $this->delete('eliminar/{doc_tercero}/{tdoc_tercero}', function ($req, $res, $args) {
        return $res->withHeader('Content-type', 'application/json')
                   ->write(
                     json_encode($this->model->tercero->eliminar($args['doc_tercero'],$args['tdoc_tercero']))
                   );   
    });
})->add(new AuthMiddleware($app));