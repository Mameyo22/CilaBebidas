<?php
class Cila_model extends CI_model{
    
    public function __construct(){
		
        $this->load->database();
    }

	public function login($username, $password){
		//Obtener el usuario
		$query = $this->db->get_where('usuarios', array('username' => $username));
		if ($query->num_rows() == 1){
			//Validar password
			$row = $query->row_array();
            if ($password == $row['userpwd']){
				return TRUE;
			}else{
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}

	public function get_user($userid, $username){
		//Obtener el usuario
		$query = $this->db->get_where('usuarios', array('username' => $username));
		if ($query->num_rows() == 1){
			$row = $query->row_array();			
			$data = array(
				'nombre' => $row['username'],
				'id' => $row['userid'],
				'password' => $row['userpwd'],
				'email' => $row['useremail'],
				'isAdmin' => $row['isadmin'],
				'picture' => $row['userpicture']			
			);
			
			return $data;
		}

	}

	public function getUsers(){
		$query = $this->db->get('usuarios');
		return $query->result_array();
	}
///////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function getarticulos($articuloid = NULL){
		if ($articuloid){
			//recuperar info de ese solo articulo
			$query = $this->db->get_where('articulos',array('articuloid' => $articuloid));
			return $query->row_array();
		}else{
			//recuperar la lista de articulos
			$query = $this->db->get('articulos');
			return $query->result_array();
		}
	}

	public function get_articulo_bc($barcode){
		//Obtener el articulo en base al codigo de barras
		$query = $this->db->get_where('articulos',array('articulobarcode' => $barcode));

		if ($query->num_rows() == 1){

			return $query->row_array();
		}else{
			return $query->num_rows();
		}

	}

	public function set_articulo($filename=''){
		//grabar un nuevo articulo
		$data = array(
			'articulodesc' => $this->input->post('articulodesc'),
			'articuloprecio' => $this->input->post('articuloprecio'),
			'articulobarcode' => $this->input->post('articulobarcode'),
			'articuloimg' => $filename		
		);

		return $this->db->insert('articulos', $data);

	}

	public function edit_articulo($filename=''){
		//editar articulo
		$articuloid = $this->input->post('articuloid');
		$data = array(
			'articulodesc' => $this->input->post('articulodesc'),
			'articuloprecio' => $this->input->post('articuloprecio'),
			'articulobarcode' => $this->input->post('articulobarcode'),
			'articuloimg' => $filename		
		);

		return $this->db->update('articulos', $data,array('articuloid'=>$articuloid ));

	}


	public function del_articulo($articuloid){
		//return $this->db->delete('articulos',array('articuloid' => $articuloid));
	}


//////////////////////////////////////////////////////////////////////////////////////////
	public function get_carrito($user_id){
		$this->db->select('*');
		$this->db->from('carrito');
		$this->db->join('articulos','carrito.articuloid=articulos.articuloid');
		$this->db->where(array('carritoid' => $user_id));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function set_carrito($user_id, $articuloid, $cantidad){
		$data = array(
			'carritoid' => $user_id,
			'articuloid' => $articuloid,
			'cantidad' => $cantidad
		);

		$this->db->insert('carrito', $data, array('carritoid2' => $user_id) );
		return $this->db->insert_id();
		
	}

	public function del_carrito($carritoitem){
		return $this->db->delete('carrito',array('carritoitem' => $carritoitem));
	}

	public function clear_carrito($user_id){
		return $this->db->delete('carrito',array('carritoid' => $user_id));
	}

	public function upd_carrito($carritoitem, $cantidad){
		//Actualiza la cantidad
		return $this->db->update('carrito', array('cantidad' => $cantidad),array('carritoitem' => $carritoitem));
	}

}
?>