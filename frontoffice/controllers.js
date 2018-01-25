var authControllers   = angular.module('authControllers', [])
    pedidoControllers = angular.module('pedidoControllers', [])
    solicitudControllers = angular.module('solicitudControllers', [])
    perfilControllers = angular.module('perfilControllers', [])
    testControllers   = angular.module('testControllers', []);

// Auth Controller
authControllers.controller('AuthLoginCtrl', ['$scope', 'restApi', '$location', 'auth',
  function ($scope, restApi, $location, auth) {
      //loader.show(true);

      $scope.ingresar = function(){

       if (auth.getUserData()) {

          $location.path('/principal');
       }
       else{

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
      
      }
  }]);


authControllers.controller('AuthLogoutCtrl', ['$scope', 'restApi', '$location', 'auth',
  function ($scope, $http, $location, auth) {
      auth.logout();
  }]);

// Listar las solicitudes por usuario
solicitudControllers.controller('solicitudListarCtrl', ['$scope', 'restApi', 'auth',
  function ($scope, restApi, auth) {
      auth.redirectIfNotExists();

      var user = auth.getUserData();
      
      $scope.NomUsuario = user.NOMBRE_EMPLEADO;

      cargarSolicitudes();

      function cargarSolicitudes(){
        //Consultamos la funcion listarporempleado del modelo solicitud de la rest
         restApi.call({
            method: 'get',
            url: 'solicitud/listarPorEmpleado/' + user.COD_EMPLEADO,
            response: function(r){
              //console.log(r);
               $scope.resultado = r;
               $scope.usuario = user.COD_EMPLEADO;

            },
            error: function(r){

            },
            validationError: function(r){

            }
        });
      }

  }]);


solicitudControllers.controller('solicitudRegistrarCtrl', ['$scope', 'restApi', '$location', 'auth',
  function ($scope, restApi, $location, auth) {
        auth.redirectIfNotExists();

        var user = auth.getUserData();

        $scope.usuario= user.COD_EMPLEADO;
        //Cargo el select con las ciudades        

        cargarCiudades();     

        function cargarCiudades(){
              restApi.call({
              method: 'get',
              url: 'ciudad/todos',
              response: function(r){
                 $scope.Ciudades = r;

              },
              error: function(r){

              },
              validationError: function(r){
                console.log(r);
              }
          });
        }
        //Se arma el arreglo para registrar la data

        // inicializo todos los togles en falso 
        $scope.activeV = false;
        $scope.activeID = false;
        $scope.activeH = false;
        $scope.activeT = false;
        //var idv = $scope.activeID;

        $scope.Solicitud = {
          COD_EMPLEADO: user.COD_EMPLEADO,
          Op:[],
          Reservas:[],
          Hoteles:[]
        };

        //funcion para agregar los vuelos
        $scope.agregaVuelo = function(){
          //Validar si marcaron una ciudad de origen, una de destino y las fechas para el vuelo
          if (typeof($scope.CiuOrigen) === 'undefined' || typeof($scope.CiuDestino) === 'undefined' || 
              typeof($scope.FSalida) === 'undefined') return;
          
          if ($scope.CiuOrigen == $scope.CiuDestino) return;

          //Conseguimos toda la data de las ciudades seleccionadas y las separamos en dos arreglos
          var sciudadOrigen = $scope.Ciudades.filter(function(x){
            return x.ID_CIUDAD == $scope.CiuOrigen;
            
          })[0];
          var sciudadDestino = $scope.Ciudades.filter(function(x){

            return x.ID_CIUDAD == $scope.CiuDestino;
            
          })[0];
          
          //DECLARO LAS VARIABLES PARA LA FECHA DE IDA Y REGRESO
          var fida, fvuelta;
          //formateo el valor de la fecha recibida para la ida
          fida = formatearFecha($scope.FSalida);

          //evaluo si la fecha de regreso no esta definida, si no 
          //se define se deja en blanco de lo contrario se formatea
          //la fecha de regreso y se le asigan a la variable
          if (typeof($scope.Fregreso) === 'undefined') {
            fvuelta = '';
          }
          else
          {
            fvuelta = formatearFecha($scope.Fregreso);
          }          

          var reserva = {
            IDCIUDAD_ORIGEN: $scope.CiuOrigen,
            CIUDAD_ORIGEN: sciudadOrigen.NOMBRE_CIUDAD,
            IDCIUDAD_DESTINO: $scope.CiuDestino,
            CIUDAD_DESTINO: sciudadDestino.NOMBRE_CIUDAD,
            FECHA_SALIDA: fida,
            FECHA_REGRESO:fvuelta
    
          };

          var validaVueloExistente = -1;

          $scope.Solicitud.Reservas.forEach(function(x,i){
            if (x.IDCIUDAD_ORIGEN == $scope.CiuOrigen && x.IDCIUDAD_DESTINO == $scope.CiuDestino) {
              validaVueloExistente = i;
              return false;
            }
          })

          if (validaVueloExistente === -1) 
          {

            $scope.Solicitud.Reservas.push(reserva);
          }else{
            $scope.Solicitud.Reservas[validaVueloExistente] = reserva;
          }
          //$scope.solicitud.reservas[0]=reservas;

          //console.log($scope.Solicitud);
        }

        $scope.agregarHotel = function(){
          if (typeof($scope.CiuHospedaje) === 'undefined' || typeof($scope.FingresoHotel) === 'undefined' || typeof($scope.FSalidaHotel) === 'undefined') return;
          
          var ciudadesHospedaje = $scope.Ciudades.filter(function(x){
            
            return x.ID_CIUDAD == $scope.CiuHospedaje;

          })[0];

          var finHotel, fsalHotel;

          finHotel = formatearFecha($scope.FingresoHotel);
          fsalHotel = formatearFecha($scope.FSalidaHotel);

          var hotel = {
            ID_CIUDADH:ciudadesHospedaje.ID_CIUDAD,
            NOMBRE_CIUDADH:ciudadesHospedaje.NOMBRE_CIUDAD,
            FINGRESO_HOTEL:finHotel,
            FSAL_HOTEL:fsalHotel
          };

          //procedimiento para validar si registro ya esta en el array,
          //si ya esta solamente lo actualizamos, de lo contrario lo agregamos.
          var validaSiExiste = -1;

          $scope.Solicitud.Hoteles.forEach(function(x,i){
            if (x.ID_CIUDADH == $scope.CiuHospedaje) {
              validaSiExiste = i;
              return false;
            }
          });

          if (validaSiExiste === -1) {
            $scope.Solicitud.Hoteles.push(hotel);
          }else{
            $scope.Solicitud.Hoteles[validaSiExiste] = hotel;
          }

        }

        $scope.retirarVuelo = function(i){
          $scope.Solicitud.Reservas.splice(i, 1);

        }
        $scope.retirarHotel = function(i){
 
          $scope.Solicitud.Hoteles.splice(i, 1);

        }

        //FUNCION PARA DAR FORMATO A LAS FECHAS
        function formatearFecha(fecha){
          var fechaOk = new Date(fecha);
          var nuevaFecha = fechaOk.getFullYear()+'/'+(fechaOk.getMonth()+1)+'/'+fechaOk.getDate();
          
          return nuevaFecha;
        }

        $scope.registrarSolicitud = function(){

          var opciones = {
            SVUELO: $scope.activeV,
            SVIDA_REGRESO: $scope.activeID,
            SHOTEL: $scope.activeH,
            STERCERO: $scope.activeT,
            COD_EMPLEADO: user.COD_EMPLEADO
          };

          $scope.Solicitud.Op[0] = opciones;

          restApi.call({
            method: 'post',
            url: 'solicitud/registrar',
            data: $scope.Solicitud,
            response: function(r){
              if (r.response) {
                $location.path('/principal');
                //console.log(r);
              }
            },
            error: function(r){
              console.log(r.errors);
            },
            validationError: function(r){

            }
          });

        }


  }]);


solicitudControllers.controller('solicitudRegistrarReservaCtrl',['$scope', 'restApi', '$location', 'auth',
  function ($scope, restApi, $location, auth) {
        //funcion con los datos necesarios para insertar el pedido
       
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

solicitudControllers.controller('SolicitudVisualizarCtrl', ['$scope', 'restApi', 'auth','$routeParams',
  function($scope,restApi,auth,$routeParams){
    //comprobamos si el usuario esta autenticado y tiene un token valido, de lo contrario se dirige a login
    auth.redirectIfNotExists();
    //si paso la prueba se carga una variable con los datos del usuario
    var user = auth.getUserData();
    //se carga una variable para el front end con el codigo del empleado y con el numero dela solicitud
    $scope.usuario= user.COD_EMPLEADO;
    $scope.numSolicitud = $routeParams.id;



}]);
perfilControllers.controller('PerfilVisualizarCtrl',['$scope', 'restApi', 'auth', '$routeParams',
  function($scope,restApi,auth,$routeParams){
      auth.redirectIfNotExists();

      var user = auth.getUserData();

      $scope.usuario= user.COD_EMPLEADO;

  }]);