<?php 
class Allreservas_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*All functions*/
	function getAllReservas(){
		$consulta = $this->db->query('CALL getReservaSupervisor()');
		if ($consulta->num_rows() > 0) {
			mysqli_next_result($this->db->conn_id); 
			//mysqli_next_result($this->db->conn_id); 
			/*row regresa una sola fila*/
			//return $consulta->row();
			return $consulta;
		}
		else
		{
			return false;
		}
	}
	function consigueInfoReserva($idreserva){

		$buscaVuelo = $this->db->query('CALL getVueloPorCodReserva('.$idreserva.')');
			/*$this->db->select('id_usuario, nom_usuario');
		      $this->db->from('usuario');
		      $this->db->where('id_usuario', $id);
		      $consulta = $this->db->get();
		      $resultado = $consulta->row();
		      return $resultado;*/
		if ($buscaVuelo->num_rows()>0) {
			mysqli_next_result($this->db->conn_id); 
			return $buscaVuelo;
		}
		else
		{
			return false;
		}
	
	}

	function getHotelFromReserva(){
		
	}
}
?>