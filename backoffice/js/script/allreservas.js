function  showAll(value){
	//console.log(value);

	/*$(function(){

		$("#"+value).click(function(){
			console.log("#"+value);
				//$("#myModal").modal({backdrop: "static"});
		});

	})*/
		console.log($('#'+value).parents('tr').find("td")[0].innerText);
		var valRecogido = $('#'+value).parents('tr').find("td")[0].innerText;
 
		$("#myModal").modal({backdrop: "static"});
		
		document.getElementById("title-modal").innerHTML=" Reserva # " + valRecogido;
	
	/*var valores="";
	 
	            // Obtenemos todos los valores contenidos en los <td> de la fila
	            // seleccionada
	            $("#"+value).parents("tr").find("td").each(function(){
	                valores+=$(value).html()+"\n";
	            });
	 /*valores = $("#"+value).parents("tr");
	  //console.log(valores[0]);
	  console.log(valores);*/
	  //console.log(valores);
}


