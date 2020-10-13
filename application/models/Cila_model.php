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
		$articulo = $this->cila_model->getarticulos($articulo);

		$data = array(
			'carritoid' => $user_id,
			'articuloid' => $articuloid,
			'cantidad' => $cantidad
		);

		return $this->db->insert('carrito', $data, array('carritoid' => $user_id) );

	}

}
?>