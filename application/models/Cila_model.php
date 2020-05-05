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
			$row = $query->row();
            if ($password == $row->userpwd)
				return TRUE;
			}else{
				return FALSE;
			}
	}

	public function get_user($userid, $username){
		//Obtener el usuario
		$query = $this->db->get_where('usuarios', array('username' => $username));
		if ($query->num_rows() == 1){
			$data = array(
				'nombre' => $row->username,
				'id' => $row->userId,
				'password' => $row->userpwd,
				'email' => $row->useremail,
				'isAdmin' => $row->isadmin,
				'picture' => $row->userpicture			
			);
			
			return $data;
		}

	}
}
?>