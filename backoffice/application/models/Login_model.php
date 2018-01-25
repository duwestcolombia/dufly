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
		
		$this->db->where('EMAIL_EMPLEADO',$usu);
		$this->db->where('PASS_EMPLEADO',$pass);
		$consul=$this->db->get('empleados');

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