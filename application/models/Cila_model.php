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
			//if (password_verify($password, $row->userpwd)){
            if ($password == $row->userpwd)
				$data = array('user_data' => array(
					'nombre' => $row->username,
					'id' => $row->userid,
					'password' => $row->userpwd,
					'email' => $row->useremail,
                    'isAdmin' => $row->isadmin,
                    'picture' => $row->userpicture			
					)
				);
				return TRUE;
			}
		}
		return FALSE;
	}}
?>