$(document).ready(function(){

verificaToken();


	//console.log(verificaToken());
});


function verificaToken(){
	var tokenRecup = JSON.parse(localStorage.getItem('data_sess'));
	console.log(tokenRecup);

	/*if (tokenRecup == "" || tokenRecup == null) {
		return false;
	}
	else
	{
		$.ajax({
		      type: "POST",
		      url: "login/validaToken",
		      data: { 'tok': tokenRecup },
		      dataType: 'json',
		      success: function(data) {
		          console.log(data);

		      },
		      error: function(error) {
		          //alert(error);
		          console.log(error);
		      }
		  });
		//return tokenRecup;
	}*/
}

function agregaToken(token){
	localStorage.setItem('DUFLY-TOKEN',token);
}
function eliminaToken(){
	localStorage.removeItem('DUFLY-TOKEN');
}
