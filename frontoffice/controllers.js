var authControllers   = angular.module('authControllers', [])
    solicitudControllers = angular.module('solicitudControllers', [])
    perfilControllers = angular.module('perfilControllers', [])
    terceroControllers = angular.module('terceroControllers', [])
    testControllers   = angular.module('testControllers', []);

    var dataOffline = {
      datos:[]
    };
    
    

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

// Logout
authControllers.controller('AuthLogoutCtrl', ['auth',
  function (auth) {
      auth.logout();
  }]);

// Listar las solicitudes por usuario
solicitudControllers.controller('solicitudListarCtrl', ['$scope', 'restApi', 'auth','validaDataOffLine',
  function ($scope, restApi, auth,validaDataOffLine) {
      auth.redirectIfNotExists();

      var dOffline = validaDataOffLine.consigueData();
      //console.log(dOffline.datos);
      
      if(typeof(dOffline) != 'undefined'){
        $scope.datosOffline = dOffline.datos;
        console.log($scope.datosOffline);
      }      
      

      var user = auth.getUserData();
      
      $scope.Usuario = user;


      cargarSolicitudes();

      function cargarSolicitudes(){
        //Consultamos la funcion listarporempleado del modelo solicitud de la rest
         restApi.call({
            method: 'get',
            url: 'solicitud/listarPorEmpleado/' + user.COD_EMPLEADO,
            response: function(r){
              
               $scope.resultado = r;
               $scope.usuario = user.COD_EMPLEADO;

            },
            error: function(r){

            },
            validationError: function(r){

            }
        });
      }

      $scope.enviarSolicitudes = function(){
        //loader.show(true);
        dOffline.datos.forEach(function(data){

          //registro solicitudes que se encuentran offline
          restApi.call({
            method: 'post',
            url: 'solicitud/registrar',
            data:data,
            response: function(r){
              if (r.response) {
                console.log(r);
                localStorage.removeItem('data');
                location.reload(true);

              }
            },
            error: function(r){
              console.log('Error '+r);
              
                         
            },
            validationError: function(r){
              console.log('Validation: '+r);
              
            }
          });


          
          
        })
      }

      $scope.rechazarSolicitudes= function() {
        var conf = confirm("¿ Esta seguro que desea eliminar todas las solicitudes pendientes ? ");
        if (conf) {
          
          localStorage.removeItem('data');
          alert("Todas las solicitudes pendientes se eliminaron");

          location.reload(true);

        } else {
          return;
        }
      }

    // *************************************************************************
    // FUNCIONES PARA ACTUALIZAR CONTRASEÑA POR PRIMERA VEZ 
    // *****************************************************************************
  //   $scope.actualizaPass = function(){
  //     console.log("ingresamos al controller listar  a la funcion actualizar");
      
  //     console.log($scope.txt_passwd,$scope.txt_confipasswd);
      

  //     if (validaPass($scope.txt_pass,$scope.txt_confipass))
  //     {
  //       var data = {
          
  //         PASS_EMPLEADO:$scope.txt_pass

  //       };
  //       // actualizar(data);
  //     }
  //     else{

  //       $scope.errorPass = "Las contraseñas no coinciden";
  //     }


  //  }

  // //  function actualizar(datos){
  // //   //console.log(datos);
  // //    restApi.call({
  // //       method: 'put',
  // //       url: 'empleado/actualizar/'+$scope.usuario,
  // //       data:datos,
  // //       response: function(r){
  // //          //console.log(r);
  // //       },
  // //       error: function(r){
  // //         console.log(r);
  // //       },
  // //       validationError: function(r){
  // //           console.log(r);
  // //       }
  // //   });
  // //  }

  //  function validaPass(pass, confipass){
  //     if (pass == confipass) {
  //       return true;
  //     }
  //     else
  //     {
  //       return false;
  //     }
  //  }
  $scope.a = function(){
    $scope.passwd="";
    console.log(document.getElementsByName('passwd').value);
    
    $scope.user = '';
    if ($scope.passwd === undefined) {
      console.log("algo salio mal");
      
    }else{

      console.log($scope.passwd);
    }

  }

  $scope.tprueba = "juanito";

  $scope.prueba = function(){
    console.log($scope.tprueba);
     
  }
      


  }]);

//Registrar las solicitudes
solicitudControllers.controller('solicitudRegistrarCtrl', ['$scope', 'restApi', '$location', 'auth',
  function ($scope, restApi, $location, auth) {

        auth.redirectIfNotExists();

        var user = auth.getUserData();


        $scope.usuario= user.COD_EMPLEADO;
        //Cargo el select con las ciudades
   


        cargarCiudades();
        cargaTerceros();
        infoUsuario();
        infoJefe();

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

        function cargaTerceros(){
              restApi.call({
              method: 'get',
              url: 'tercero/obtenerTodos',
              response: function(r){
                 $scope.Terceros = r;


              },
              error: function(r){
                console.log(r);
              },
              validationError: function(r){
                console.log(r);
              }
          });
        }

        function infoUsuario(){
           restApi.call({
              method: 'get',
              url: 'empleado/obtener/' + $scope.usuario,
              response: function(r){

                 $scope.mailEmp =  r.EMAIL_EMPLEADO;
                 $scope.nomEmp = r.NOMBRE_EMPLEADO;
              },
              error: function(r){
                console.log(r);
              },
              validationError: function(r){
                  console.log(r);
              }
          });
        }

        function infoJefe(){
          restApi.call({
              method: 'get',
              url: 'empleado/obtenerJefe/' + $scope.usuario,
              response: function(r){

                 $scope.mailJefe = r.EMAIL_JEFE;
              },
              error: function(r){
                console.log(r);
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
              typeof($scope.FSalida) === 'undefined')  return;

          if ($scope.CiuOrigen == $scope.CiuDestino) return;

          //Conseguimos toda la data de las ciudades seleccionadas y las separamos en dos arreglos
          var sciudadOrigen = $scope.Ciudades.filter(function(x){
            return x.ID_CIUDAD == $scope.CiuOrigen;

          })[0];
          var sciudadDestino = $scope.Ciudades.filter(function(x){

            return x.ID_CIUDAD == $scope.CiuDestino;

          })[0];

          //DECLARO LAS VARIABLES PARA LA FECHA DE IDA Y REGRESO
          var fida, fidaComplete,hida,fvueltaComplete,fvuelta,hvuelta;
          //formateo el valor de la fecha recibida para la ida
          fida = formatearFecha($scope.FSalida);
          hida = formatearHora($scope.HSalida);
          fidaComplete = fida+" "+hida;
          //evaluo si la fecha de regreso no esta definida, si no
          //se define se deja en blanco de lo contrario se formatea
          //la fecha de regreso y se le asigan a la variable
          if (typeof($scope.Fregreso) === 'undefined') {
         
            fvueltaComplete = '';
          }
          else
          {
            fvuelta = formatearFecha($scope.Fregreso);
            hvuelta = formatearHora($scope.Hregreso);
            fvueltaComplete = fvuelta+" "+hvuelta;
          }

          var reserva = {
            IDCIUDAD_ORIGEN: $scope.CiuOrigen,
            CIUDAD_ORIGEN: sciudadOrigen.NOMBRE_CIUDAD,
            IDCIUDAD_DESTINO: $scope.CiuDestino,
            CIUDAD_DESTINO: sciudadDestino.NOMBRE_CIUDAD,
            FECHA_SALIDA: fidaComplete,
            FECHA_REGRESO:fvueltaComplete

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

          if (typeof($scope.CiuHospedaje) === 'undefined' || typeof($scope.FingresoHotel) === 'undefined' || typeof($scope.FSalidaHotel) === 'undefined' || typeof($scope.TipoHabitacion) === 'undefined') return;

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
            FSAL_HOTEL:fsalHotel,
            TIPO_HABITACION:$scope.TipoHabitacion
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
        function formatearHora(hora){
          var horaOk = new Date(hora);
          var nuevaHora = horaOk.getHours()+":"+horaOk.getMinutes()+":"+horaOk.getSeconds();

          return nuevaHora;
        }

        //var dataTerceros = [0];

        $scope.searchPassager = function(){

          /*Filtramos el arreglo inicial por el numero de documento y le pasamos
          El resultado a un nuevo arreglo*/
          var arrayFiltrado = $scope.Terceros.filter(function(num){
            return num.DOC_TERCERO === $scope.txt_NumDoc;
          });
          /*Recorremos el nuevo arreglo con un foreach, siempre y cuenado este contenga datos.
          Si el arreglo no tiene datos, limpiamos los input, de lo contrario les asignamos el valor
          correspondiente.*/

          if (arrayFiltrado.length > 0) {
            arrayFiltrado.forEach(function(x){
              $scope.TipoDoc = x.TIPDOC_TERCERO;
              $scope.txt_ntercero = x.NOM_TERCERO;
              $scope.txt_TelTercero = x.TEL_TERCERO;
              $scope.txt_FnacimientoTercero = x.FNACIMIENTO_TERCERO;
            });
          }
          else
          {
            $scope.TipoDoc = '';
            $scope.txt_ntercero = '';
            $scope.txt_TelTercero = '';
            $scope.txt_FnacimientoTercero = '';
          }


          //console.log($scope.Terceros.DOC_TERCERO === $scope.txt_NumDoc)

        }




        $scope.registrarSolicitud = function(){
          //si no selecciono ninguna opcion para registrar no hacemos nada
          if ($scope.activeV == false && $scope.activeH == false && $scope.activeT == false) return;
          if ($scope.txt_objetivo === undefined) {

            $scope.error_message = "¡Error! Debe escribir un objetivo para esta solicitud, este campo es obligatorio.";

            return;
          }

          var TipoDocumento, NumeroDocumento;

          if ($scope.TipoDoc === undefined && $scope.txt_NumDoc === undefined) {
            TipoDocumento = 'CC';
            NumeroDocumento = '1';
          }
          else
          {
            TipoDocumento = $scope.TipoDoc;
            NumeroDocumento = $scope.txt_NumDoc;
          }

          var opciones = {
            SVUELO: $scope.activeV,
            SVIDA_REGRESO: $scope.activeID,
            SHOTEL: $scope.activeH,
            STERCERO: $scope.activeT,
            COD_EMPLEADO: user.COD_EMPLEADO,
            TIPDOC_TERCERO : TipoDocumento,
            DOC_TERCERO: NumeroDocumento,
            OBJETIVO_SOLICITUD:$scope.txt_objetivo,
            MAIL_EMPLEADO:$scope.mailEmp,
            NOM_EMPLEADO:$scope.nomEmp,
            MAIL_JEFE:$scope.mailJefe
          };

          $scope.Solicitud.Op[0] = opciones;

          //Validamos si envio un hotel o un vuelo, si estos array estan vacios no hacemos nada
          //if ($scope.Solicitud.Reservas.length == 0  || $scope.Solicitud.Hoteles.length == 0) return;

          
          

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
              console.log(r);
              
              dataOffline.datos.push($scope.Solicitud);
                           
              localStorage.setItem('data',JSON.stringify(dataOffline));              
            },
            validationError: function(r){

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
                  //console.log(auth.getUserData());
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

//visualizar las solicitudes detalladas
solicitudControllers.controller('SolicitudVisualizarCtrl', ['$scope', 'restApi', 'auth','$routeParams',
  function($scope,restApi,auth,$routeParams){
    //comprobamos si el usuario esta autenticado y tiene un token valido, de lo contrario se dirige a login
    auth.redirectIfNotExists();
    //si paso la prueba se carga una variable con los datos del usuario
    var user = auth.getUserData();
    //se carga una variable para el front end con el codigo del empleado y con el numero dela solicitud
    $scope.usuario= user.COD_EMPLEADO;
    $scope.numSolicitud = $routeParams.id;

    obtener();

    function obtener(){
       restApi.call({
          method: 'get',
          url: 'solicitud/obtener/' + $routeParams.id,
          response: function(r){
             $scope.rSolicitud = r;

          },
          error: function(r){

          },
          validationError: function(r){
              console.log(r);
          }
      });
    }
}]);

//visualizar el perfil del usuario
perfilControllers.controller('PerfilVisualizarCtrl',['$scope', 'restApi', 'auth', 
  function($scope,restApi,auth){
      auth.redirectIfNotExists();

      var user = auth.getUserData();

      $scope.usuario= user.COD_EMPLEADO;

      verPerfil();

      function verPerfil(){
         restApi.call({
            method: 'get',
            url: 'empleado/obtener/' + $scope.usuario,
            response: function(r){
               $scope.txt_nombre = r.NOMBRE_EMPLEADO;
               $scope.txt_fnacimiento =r.FNACIMIENTO_EMPLEADO;
               $scope.txt_tel =r.TEL_EMPLEADO;
               $scope.txt_email =r.EMAIL_EMPLEADO;
            },
            error: function(r){
              console.log(r);
            },
            validationError: function(r){
                console.log(r);
            }
        });
      }


     $scope.actualizaPerfil = function(){

        /*if ($scope.txt_pass === 'unedfined' || $scope.txt_confipass === 'undefined') {
            var data = {
              nom_empleado:$scope.txt_nombre,
              fnac_empleado:$scope.txt_fnacimiento,
              tel_empleado:$scope.txt_tel,
              email_empleado:$scope.txt_email
            };
            actualizar(data);
        }*/

        if (validaPass($scope.txt_pass,$scope.txt_confipass))
        {
          var data = {
            NOMBRE_EMPLEADO:$scope.txt_nombre,
            FNACIMIENTO_EMPLEADO:$scope.txt_fnacimiento,
            TEL_EMPLEADO:$scope.txt_tel,
            EMAIL_EMPLEADO:$scope.txt_email,
            PASS_EMPLEADO:$scope.txt_pass

          };
          actualizar(data);
        }
        else{

          $scope.errorPass = "Las contraseñas no coinciden";
        }


     }

     function actualizar(datos){
      //console.log(datos);
       restApi.call({
          method: 'put',
          url: 'empleado/actualizar/'+$scope.usuario,
          data:datos,
          response: function(r){
             //console.log(r);
          },
          error: function(r){
            console.log(r);
          },
          validationError: function(r){
              console.log(r);
          }
      });
     }

     function validaPass(pass, confipass){
        if (pass == confipass) {
          return true;
        }
        else
        {
          return false;
        }
     }

}]);

terceroControllers.controller('TerceroRegistrarCtrl',['$scope', 'restApi', 'auth', '$routeParams', '$location',
  function($scope,restApi,auth,$routeParams, $location){

      //if (typeof($scope.TipoDoc) === 'undefined' || typeof($scope.txt_NumDoc) === 'undefined') return;
      auth.redirectIfNotExists();

      var user = auth.getUserData();

      $scope.usuario= user.COD_EMPLEADO;

      var datos = {};

      function formatearFecha(fecha){
        var fechaOk = new Date(fecha);
        var nuevaFecha = fechaOk.getFullYear()+'/'+(fechaOk.getMonth()+1)+'/'+fechaOk.getDate();

        return nuevaFecha;
      }




      $scope.registrarTercero = function(){
         //var fnacimiento = formatearFecha2($scope.txt_FnacimientoTercero);
         var fnacimiento;
         if (typeof($scope.txt_FnacimientoTercero) === 'undefined') {
            fnacimiento = '';
         }
         else
         {
            fnacimiento = formatearFecha($scope.txt_FnacimientoTercero);
         }


         datos = {
           TIPDOC_TERCERO:$scope.DocTercero,
           DOC_TERCERO:$scope.txt_NumDoc,
           NOM_TERCERO:$scope.txt_ntercero,
           TEL_TERCERO:$scope.txt_TelTercero,
           FNACIMIENTO_TERCERO:fnacimiento,
           REGPOR_TERCERO:user.COD_EMPLEADO,
           FREG_TERCERO:''
         };

         restApi.call({
            method: 'post',
            url: 'tercero/registrar',
            data:datos,
            response: function(r){
               $location.path('/principal/registrar');
            },
            error: function(r){


              var error = r.data.exception;
              var codigoError;

              error.forEach(function(x){
                codigoError = x.code;
              });
              console.log("Error # "+codigoError+"En la base de datos");

              /*switch(codigoError){

                case 23000:
                  //$scope.errordb = codigoError;
                  $scope.msgError = codigoError;
                  //"El tercero ya se encuentra registrado.";
                  break;

              }*/
            },
            validationError: function(r){

               var dataValidate = {
                  TIPDOC:r.TIPDOC_TERCERO,
                  DOC:r.DOC_TERCERO,
                  NOM:r.NOM_TERCERO
                }

               $scope.validation = dataValidate;

            }
        });
      }

}]);
