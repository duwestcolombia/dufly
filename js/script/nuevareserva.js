$(document).ready(function(){
		/*$("#OpVuelo").hide();
		$("#txt_nomtercero").hide();
		//$('select').material_select();
		$("#dataVuelo").hide();
		$("#dataHotel").hide();
		$("#dateReturn").hide();
		$("#btn_NuevaReserva").hide();

		$('#btn_registrar').attr("disabled", true);

		var opcion;
		var tipoVuelo;
		var contOpcion;*/
		//$('#btn_registrar').attr("disabled", true);
		$("#dataHotel").hide();
		$('#infoTerceros').hide();

		$("#datetimepicker_fnacimiento").datetimepicker({
			language: 'es-ES',
			// Hora de inicio
			time_start: '05:00', 

			// y Hora final de cada dia
			time_end: '22:00',  
			// intervalo de tiempo entre las hora, en este caso son 30 minutos
			time_split: '30',
			format: 'YYYY-MM-DD',  
			tooltips:{
				today:'Dia actual'
			}
		});
	});

	$(function(){
		// Clona la fila oculta que tiene los campos base, y la agrega al final de la tabla
		//tr:eq(Aqui el numero de tr o fila a clonar) 
		$(document).on('click',"#agregaDestino", function(){
			/*CLONAR DE MANERA SENCILLA UN DIV*/
			/*---------------------------------------------------*/
			/*var clonDestino = $("#fila-vuelo").clone();
			$("#result-clonVuelo").before(clonDestino);		*/	
			/*---------------------------------------------------*/
			/*CLONAR DE MANERA QUE CADA DIV POSEA UN ID DIFERENTE */
				// get the last DIV which ID starts with ^= "klon"
			    var $div = $('div[id^="fila-vuelo"]:last');
					
					// Read the Number from that DIV's ID (i.e: 3 from "fila-vuelo3")
					// And increment that number by 1
			    var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
			
					// Clone it and assign the new ID (i.e: from num 4 to ID "fila-vuelo4")
				var $filaVuelo = $div.clone().prop('id', "fila-vuelo"+num );
					
					// Finally insert $filaVuelo wherever you want
			    $div.after( $filaVuelo);
		});
				 
		// Evento que selecciona la fila y la elimina 
		$(document).on("click","#eliminaDestino",function(){
			var parent = $('div[id^="fila-vuelo"]:last');
			$(parent).remove();
		});

		$(document).on('click',"#mas", function(){
			/*CLONAR DE MANERA SENCILLA UN DIV*/
			/*---------------------------------------------------*/
			/*var divClon=$("#fila-hotel").clone();
			$("#result-clonardiv").before(divClon);*/
			/*---------------------------------------------------*/

			/*CLONAR DE MANERA QUE CADA DIV POSEA UN ID DIFERENTE */
				// get the last DIV which ID starts with ^= "klon"
			    var $div = $('div[id^="fila-hotel"]:last');
					
					// Read the Number from that DIV's ID (i.e: 3 from "fila-vuelo3")
					// And increment that number by 1
			    var num = parseInt( $div.prop("id").match(/\d+/g), 10 ) +1;
			
					// Clone it and assign the new ID (i.e: from num 4 to ID "fila-vuelo4")
				var $filaHotel = $div.clone().prop('id', "fila-hotel"+num );

				
					// Finally insert $filaHotel wherever you want
			    $div.after( $filaHotel);

		});
		// Evento que selecciona la fila y la elimina 
		$(document).on("click","#menos",function(){
			var parent = $('div[id^="fila-hotel"]:last');
			$(parent).remove();
		});


	});	

	function validaUno(value){

		if (value=="vuelo") {
			$("#OpVuelo").show();
			$("#dataVuelo").show();
			$("#dataHotel").hide();
			
			
			$("#txt_origen").attr("required",true);
			$("#txt_destino").attr("required",true);
			$("#fida").attr("required",true);

			$("#txt_ciudadhotel").attr("required",false);
			$("#fingreso_hotel").attr("required",false);
			$("#fsalida_hotel").attr("required",false);
		


		}
		else if(value=="hotel"){
			$("#OpVuelo").hide();
			$("#dataVuelo").hide();
			$("#dataHotel").show();
			

			$("#txt_origen").attr("required",false);
			$("#txt_destino").attr("required",false);
			$("#fida").attr("required",false);

			$('#btn_registrar').attr("disabled", false);

			$("#txt_ciudadhotel").attr("required",true);
			$("#fingreso_hotel").attr("required",true);
			$("#fsalida_hotel").attr("required",true);
			


		}
		else if (value=="vueloHotel") {
			$("#OpVuelo").show();
			$("#dataVuelo").show();
			$("#dataHotel").show();
			$("#dateReturn").hide();
			
			$('#btn_registrar').attr("disabled", false);

			$("#txt_origen").attr("required",true);
			$("#txt_destino").attr("required",true);
			$("#fida").attr("required",true);

			$("#txt_ciudadhotel").attr("required",true);
			$("#fingreso_hotel").attr("required",true);
			$("#fsalida_hotel").attr("required",true);

		}

	}

	function validaDos(value){
		if (value=="ida") {
			$("#radioIdaRegreso").attr( "checked", false );
			$("#dateReturn").hide();
			$('#btn_registrar').attr("disabled", false);
			tipoVuelo=value;
			document.getElementById("opcionVuelo").value = tipoVuelo;
		}
		else{
			$("#radioIda").attr( "checked", false );
			$('#btn_registrar').attr("disabled", false);
			$("#dateReturn").show();
			tipoVuelo=value;
			document.getElementById("opcionVuelo").value = tipoVuelo;
		}
	}
	function validaTercero(value){
		if (value=="si") {
			$('#infoTerceros').show();
		}
		else
		{
			$('#infoTerceros').hide();
		}
	}

	/*$(function () {
        $('#datetimepicker_fingreso').datetimepicker({
        	language: 'es-ES',
        	// Hora de inicio
        	time_start: '05:00', 

        	// y Hora final de cada dia
        	time_end: '22:00',  
        	// intervalo de tiempo entre las hora, en este caso son 30 minutos
        	time_split: '30',
        	format: 'YYYY-MM-DD HH:mm',  
        	tooltips:{
        		today:'Dia actual'
        	}
        	});

        $('#datetimepicker_fsalida').datetimepicker({
        	language: 'es-ES',
        	// Hora de inicio
        	time_start: '05:00', 

        	// y Hora final de cada dia
        	time_end: '22:00',  
        	// intervalo de tiempo entre las hora, en este caso son 30 minutos
        	time_split: '30',
        	format: 'YYYY-MM-DD HH:mm',  
        	tooltips:{
        		today:'Dia actual'
        	}
        	});
        $('#datetimepicker_fida').datetimepicker({
        	language: 'es-ES',
        	// Hora de inicio
        	time_start: '05:00', 

        	// y Hora final de cada dia
        	time_end: '22:00',  
        	// intervalo de tiempo entre las hora, en este caso son 30 minutos
        	time_split: '30',
        	format: 'YYYY-MM-DD HH:mm',  
        	tooltips:{
        		today:'Dia actual'
        	}
        	});
        $('#datetimepicker_fregreso').datetimepicker({
        	language: 'es-ES',
        	// Hora de inicio
        	time_start: '05:00', 

        	// y Hora final de cada dia
        	time_end: '22:00',  
        	// intervalo de tiempo entre las hora, en este caso son 30 minutos
        	time_split: '30',
        	format: 'YYYY-MM-DD HH:mm',  
        	tooltips:{
        		today:'Dia actual'
        	}
        	});
    });*/

function picker(value){

	$(function(){

		$("#"+value+">div>div[id$='fida']").datetimepicker({
			language: 'es-ES',
			// Hora de inicio
			time_start: '05:00', 

			// y Hora final de cada dia
			time_end: '22:00',  
			// intervalo de tiempo entre las hora, en este caso son 30 minutos
			time_split: '30',
			format: 'YYYY-MM-DD HH:mm',  
			tooltips:{
				today:'Dia actual'
			}
		});

		$("#"+value+">div>div[id$='fregreso']").datetimepicker({
			language: 'es-ES',
			// Hora de inicio
			time_start: '05:00', 

			// y Hora final de cada dia
			time_end: '22:00',  
			// intervalo de tiempo entre las hora, en este caso son 30 minutos
			time_split: '30',
			format: 'YYYY-MM-DD HH:mm',  
			tooltips:{
				today:'Dia actual'
			}
		});

		$("#"+value+">div>div[id$='fingreso']").datetimepicker({
			language: 'es-ES',
			// Hora de inicio
			time_start: '05:00', 

			// y Hora final de cada dia
			time_end: '22:00',  
			// intervalo de tiempo entre las hora, en este caso son 30 minutos
			time_split: '30',
			format: 'YYYY-MM-DD HH:mm',  
			tooltips:{
				today:'Dia actual'
			}
		});

		$("#"+value+">div>div[id$='fsalida']").datetimepicker({
			language: 'es-ES',
			// Hora de inicio
			time_start: '05:00', 

			// y Hora final de cada dia
			time_end: '22:00',  
			// intervalo de tiempo entre las hora, en este caso son 30 minutos
			time_split: '30',
			format: 'YYYY-MM-DD HH:mm',  
			tooltips:{
				today:'Dia actual'
			}
		});


	});	
}

/*$(function(){
	//$("#dpt_prueba:last-child").datetimepicker();
	$("#dpt_prueba:last-child").css("background-color", "yellow");
})*/
