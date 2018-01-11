var authControllers   = angular.module('authControllers', []),
    pedidoControllers = angular.module('pedidoControllers', [])
    solicitudControllers = angular.module('solicitudControllers', [])
    testControllers   = angular.module('testControllers', []);

// Auth Controller
authControllers.controller('AuthLoginCtrl', ['$scope', 'restApi', '$location', 'auth',
  function ($scope, restApi, $location, auth) {
      //loader.show(true);

      $scope.ingresar = function(){


        restApi.call({
            method: 'post',
            url: 'auth/autenticar',
            data: {
              Correo:$scope.Correo,
              Password:$scope.Password
            },
            response: function(r){
                if (r.response) {
                  auth.setToken(r.result);
                  //console.log(auth);
                  $location.path('/principal');
                }else{

                  alert("Credenciales no validas");
                }
            },
            error: function(r){

            },
            validationError: function(r){

            }
        });

      }
  }]);

authControllers.controller('AuthLogoutCtrl', ['$scope', 'restApi', '$location', 'auth',
  function ($scope, $http, $location, auth) {
      auth.logout();
  }]);

// Solicitud Controller
solicitudControllers.controller('solicitudListarCtrl', ['$scope', 'restApi', 'auth',
  function ($scope, restApi, auth) {
      auth.redirectIfNotExists();

      var user = auth.getUserData();
      console.log(user);
      $scope.usuario = user.NOMBRE_EMPLEADO;

      /*cargarSolicitudes();

      function cargarSolicitudes(){

         restApi.call({
            method: 'get',
            url: 'solicitud/listarPorEmpleado/' + user.id,
            response: function(r){
               $scope.model = r;

            },
            error: function(r){

            },
            validationError: function(r){

            }
        });
      }*/

  }]);

// Pedido Controller
pedidoControllers.controller('PedidosListadoCtrl', ['$scope', 'restApi', 'auth',
  function ($scope, restApi, auth) {
      auth.redirectIfNotExists();

      var user = auth.getUserData();

      $scope.usuario = user.Nombre;

      cargarPedidos();

      function cargarPedidos(){

         restApi.call({
            method: 'get',
            url: 'pedido/listarPorEmpleado/' + user.id,
            response: function(r){
               $scope.model = r;

            },
            error: function(r){

            },
            validationError: function(r){

            }
        });
      }

  }]);

pedidoControllers.controller('PedidosRegistrarCtrl', ['$scope', 'restApi', '$location', 'auth',
  function ($scope, restApi, $location, auth) {
        //funcion con los datos necesarios para insertar el pedido
        $scope.Pedido = {
          Cliente: $scope.Cliente,
          Total: 0,
          Empleado_id: auth.getUserData().id,
          Detalle:[]
        };


        $scope.retiraProducto = function(i){
          $scope.Pedido.Detalle.splice(i, 1);
          calculaTotal();
        }



        //Registrar los productos
        $scope.registraPedido = function(){
          //validamos que este escrito el nombre del cliente y que tenga detalle
          if (typeof($scope.Cliente) === 'undefined' || $scope.Pedido.Detalle.length == 0) return;
          

          //pasar los datos del cliente acutal
          $scope.Pedido.Cliente = $scope.Cliente;

          //Mandamos la data a la API
           restApi.call({
              method: 'post',
              url: 'pedido/guardar',
              data: $scope.Pedido,
              response: function(r){
                 if (r.response) {
                  $location.path('/pedidos');
                 }

              },
              error: function(r){

              },
              validationError: function(r){

              }
          });

        }

        //Agregar los productos
        $scope.agregaProducto = function(){

          //validamos que este marcado un producto y que tenga una cantidad
          if (typeof($scope.Cantidad) === 'undefined' || typeof($scope.Producto) === 'undefined') return;
          //la funcion filter compara entre dos valores y si coincide lo regresa
          var productoSeleccionado = $scope.Productos.filter(function(x){
            //Este producto corresponde al ng-model del txt producto
            return x.id == $scope.Producto;
          })[0];

          //validar si ya existe
          var indiceSiExiste = -1;

          $scope.Pedido.Detalle.forEach(function(x,i){
            if (x.Producto_id == $scope.Producto) {
              indiceSiExiste = i;
              return false;
            }
          })

          //console.log(productoSeleccionado);
          var detalle = {
            Producto_id: productoSeleccionado.id,
            Cantidad: $scope.Cantidad,
            Producto: productoSeleccionado.Nombre,
            Imagen: productoSeleccionado.Imagen,
            PrecioUnitario: productoSeleccionado.Precio,
            Total: $scope.Cantidad * productoSeleccionado.Precio
          };

          if (indiceSiExiste === -1) {

            $scope.Pedido.Detalle.push(detalle);
          }else{
            $scope.Pedido.Detalle[indiceSiExiste] =detalle;
          }
       

          calculaTotal();

          'Limpiar la cantidad'
          $scope.Cantidad = '';
        }


        function calculaTotal(){
          var t = 0;

          $scope.Pedido.Detalle.forEach(function(x){
            t += x.Total;
          })
          $scope.Pedido.Total = t;
        }


        cargarProductos();
        
        function cargarProductos(){
              restApi.call({
              method: 'get',
              url: 'producto/todos',
              response: function(r){
                 $scope.Productos = r;

              },
              error: function(r){

              },
              validationError: function(r){
                console.log(r);
              }
          });
        }
  }]);

pedidoControllers.controller('PedidosVisualizarCtrl', ['$scope', 'restApi', '$location', '$routeParams',
  function ($scope, restApi, $location, $routeParams) {
      
      inicializar();

      function inicializar(){
        estados();
      }

      function estados(){
            restApi.call({
            method: 'get',
            url: 'pedido/estados',
            response: function(r){
               $scope.estados = r;
               obtener();

            },
            error: function(r){

            },
            validationError: function(r){
              console.log(r);
            }
        });
      }
      function obtener(){
         restApi.call({
            method: 'get',
            url: 'pedido/obtener/' + $routeParams.id,
            response: function(r){
               $scope.model = r;
               $scope.Estado = r.Estado_id;

            },
            error: function(r){

            },
            validationError: function(r){
                console.log(r);
            }
        });
      }
      $scope.actualizaEstado = function(){
        restApi.call({
            method: 'put',
            url: 'pedido/actualizaEstado/'+$scope.model.id,
            data: {
              Estado_id: $scope.Estado
            },
            response: function(r){
                if (r.response) {
                  $location.path('pedidos')
                }
            },
            error: function(r){
                
            },
            validationError: function(r){
                console.log(r);
            }
        });
      }

  }]);

// Test controller
testControllers.controller('TestCtrl', ['$scope', 'restApi', 'auth',
  function ($scope, restApi, auth) {
      
      validaEntidad();
      
      function validaEntidad(){
          restApi.call({
              method: 'post',
              url: 'test/valida',
              response: function(r){

              },
              error: function(r){
                  
              },
              validationError: function(r){
                  console.log(r);
              }
          });
      }
      
      function autentica(){
          restApi.call({
              method: 'get',
              url: 'test/auth',
              response: function(r){
                  auth.setToken(r);
                  console.log(auth.getUserData());
                  validaAunteticacion();
              },
              error: function(r){

              },
              validationError: function(r){

              }
          });
      }
      
      function validaAunteticacion(){
          restApi.call({
              method: 'get',
              url: 'test/auth/validate',
              response: function(r){
                  console.log(r);
              },
              error: function(r){

              },
              validationError: function(r){

              }
          });
      }
  }]);