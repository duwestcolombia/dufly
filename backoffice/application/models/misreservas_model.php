<?php 

class Misreservas_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	/*all functions here.*/
	function getReservasVuelos(){
		$consulta = $this->db->query('CALL getReservasVuelos()');
		if ($consulta->num_rows() > 0) {
			
			mysqli_next_result($this->db->conn_id); 
			/*row regresa una sola fila*/
			//return $consulta->row();
			return $consulta;
		}
		else
		{
			return false;
		}
	}
	function getReservasHoteles(){
		$consultahotel = $this->db->query('CALL getReservasHoteles()');
		if ($consultahotel->num_rows() > 0) {

			mysqli_next_result($this->db->conn_id); 
			/*row regresa una sola fila*/
			//return $consultahotel->row();
			return $consultahotel;
		}
		else
		{
			return false;
		}
	}
}
?>