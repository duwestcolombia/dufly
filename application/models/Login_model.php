<?php 

class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*all functions here.*/
	function getUsusario($usu,$pass){
		
		$this->db->where('email_usuario',$usu);
		$this->db->where('pass_usuario',$pass);
		$consul=$this->db->get('usuarios');

		if ($consul) {
			return $consul->row();
		}
		else
		{
			return false;
		}
	}
}
?>