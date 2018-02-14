<?php 
 if (!defined('BASEPATH')) exit('No direct script access allowed');
class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*all functions here.*/
	function autenticar($usu,$pass){
		
		return RestApi::call(
			RestApiMethod::POST,
			"auth/autenticar",
			[
				'Correo'=>$usu,
				'Password'=>$pass
			]
		);
	}
}
?>