<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cila extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('cila_model');

	}
    public function index(){
        $data['title'] = 'Lista de Precios';
        $this->loadview('index.php',$data);
    }

    public function loadview($view = NULL, $data = NULL){
        $this->load->view('templates/header.php',$data);
        $this->load->view('templates/sidebar.php',$data);
        if (is_null($view)){
            $this->load->view('index.php', $data);
        }else{
            $this->load->view($view, $data);
        }
        $this->load->view('templates/footer.php', $data);
    }

    public function login(){
        $data['title'] = 'Ingreso al Sistema';
		$this->form_validation->set_rules('username','Usuario', 'trim|required');
		$this->form_validation->set_rules('userpassword','Contraseña','trim|required');

		if ($this->form_validation->run() == FALSE){
			if (isset($this->session->userdata['logged_in'])){
				//Ya se encuentra logueado
				redirect(base_url('index.php/cila'));
			}else{
				//Mostrar form de login
                $this->load->view('login', $data);
			}
		}else{
			//Validar logueo
			$username = $this->input->post('username');
			$userpassword = $this->input->post('userpassword');
			
			$result = $this->cila_model->login($username, $userpassword);

			if ($result == TRUE){
				//login exitoso, guardar sesion
				$result = $this->cila_model->get_user(false,$username);
				if ($result != FALSE){
					$session_data = array(
						'userid' => $result['id'],
						'username' => $result['nombre'],
						'email' => $result['email'],
                        'isAdmin' => $result['isAdmin'],
                        'picture' => $result['picture']
					);
				}
				//Agregar datos a la sesion
				$this->session->set_userdata('logged_in',$session_data);
				redirect(base_url('index.php/Cila'));
			}else{
				$data['error_message'] = 'Usuario o Contraseña erronea';
				$this->load->view('login', $data);
			}
		}
	}

	public function logout(){
		//Remover session data
		$sess_array = array(
			'username' => ''
		);
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Sesión finalizada';
		$this->load->view('login', $data);
	}

}

?>