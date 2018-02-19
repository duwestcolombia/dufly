<?php 

class Reserva_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	function getPaisCiudad()
	{
		/*Consulto el procedimiento creado en la base de datos*/
		$consulta = $this->db->query('CALL GETPAISESCIUDADES()');
		if ($consulta->num_rows() > 0) {
			/*regresa un arreglo con multiples filas*/
			return $consulta->result();
		}
		else
		{
			return false;
		}
	}
	function numMaxSolicitud(){

		$consulta = $this->db->query('CALL numMaxSolicitud()');
		if ($consulta->num_rows() > 0) {

			//add this two line 
			mysqli_next_result($this->db->conn_id); 
			//end of new code


			/*row regresa una sola fila*/
			return $consulta->row();
		}
		else
		{
			return false;
		}
	}
	function insertarReserva($dataReserva){

		$this->db->insert("reservas",$dataReserva);
	}
	function insertSolicitud($dataSolicitud){
		$this->db->insert("solicitudes",$dataSolicitud);

	}

	function insertarHotel($datosHotel){

		$this->db->insert("dufly_hoteles",$datosHotel);
		echo "<script>alert('Su reserva de Hotel fue registrada con exito.');</script>";

		redirect('index.php/reserva', 'refresh');
	}

	function insertarVuelo($datosOrigen,$datosDestino){

		$this->db->insert("dufly_origenes",$datosOrigen);
		$this->db->insert("dufly_destinos",$datosDestino);
		echo "<script>alert('Su reserva de Vuelo fue registrada con exito.');</script>";

		redirect('index.php/reserva', 'refresh');
	}

	function insertar($datosOrigen,$datosDestino,$datosHoteles){

		$this->db->insert("dufly_origenes",$datosOrigen);
		$this->db->insert("dufly_destinos",$datosDestino);
		$this->db->insert("dufly_hoteles",$datosHoteles);
		echo "<script>alert('Su reserva de Vuelo + Hotel fue registrada con exito.');</script>";

		redirect('index.php/reserva', 'refresh');



	}

}

 ?>