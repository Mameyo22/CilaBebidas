<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cila extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('cila_model');
	}
    public function index(){
		//Validar que se encuentre logueado
		$data['title'] = 'Lista de Precios';
		$data['active'] = 1;
		//Obtener la lista de articulos
		$data['articulos'] = $this->cila_model->getarticulos();
        $this->loadview('index.php',$data);
    }

    public function loadview($view = NULL, $data = NULL,$onlyadmin = FALSE){
		if (isset($this->session->userdata['logged_in'])){
			//Ya se encuentra logueado, mostrar la pagina que pide

			//Obtner carrito de compras
			if (isset($_SESSION['logged_in'])){
				$userid = $_SESSION['logged_in']['userid'];
				$data['carrito'] = $this->cila_model->get_carrito($userid);
			}


			$this->load->view('templates/header.php',$data);
			$this->load->view('templates/sidebar.php',$data);
			if (is_null($view)){
				$this->load->view('index.php', $data);
			}else{
				$isAdmin = $this->session->userdata['logged_in']['isAdmin'];
				if ($onlyadmin && $isAdmin == 0 ){
					$this->load->view('templates/forbbiden');
				}else{
					$this->load->view($view, $data);
				}
								
			}
			$this->load->view('templates/footer.php', $data);
		}else{
			//Mostrar form de login
			$this->load->view('login', $data);
		}
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
		$sess_array = array();
		$this->session->unset_userdata('logged_in', $sess_array);
		$data['message_display'] = 'Sesión finalizada';
		$this->load->view('login', $data);
	}

	public function users(){
		$data['title'] = 'Usuarios';
		$data['active'] = 3; //punto 2 del sidebar
		$data['usuarios'] = $this->cila_model->getUsers();
		$this->loadview('users',$data,TRUE); //Solo admin
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	public function articulos(){
		$data['title'] = 'ABM de Artículos';
		$data['active'] = 2; //punto 2 del sidebar
		//Obtener la lista de articulos
		$data['articulos'] = $this->cila_model->getarticulos();
		$this->loadview('articulos',$data, TRUE); //solo admin
	}

	public function nuevoarticulo(){
		$data['title'] = 'Nuevo Articulo';
		$data['active'] = 2; //punto 2 del sidebar
		
		$this->form_validation->set_rules('articuloprecio','Precio','required');

		if ($this->form_validation->run() === FALSE){
			$this->loadview('nuevoarticulo', $data);	
		}else{
			//subir la imagen
			/*
			$filename = '';
			if (isset($_FILES['articuloimg'])){

				$config['upload_path'] = './img/products/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$config['max_width'] = 1500;
				$config['max_height'] = 1500;
				
				$new_name = time().$_FILES["articuloimg"]['name'];
				$config['file_name'] = $new_name;
	
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('articuloimg')) {
					$error = array('error' => $this->upload->display_errors());
					$this->loadview('nuevoarticulo', $error);	
				}else{
					$metadata = $this->upload->data();
					$filename=$metadata['file_name'];
				}
			}*/
			$filename = '';
			$this->cila_model->set_articulo($filename);
			redirect(base_url('index.php/cila/articulos'));
		}	
	}		

	public function viewarticulo($articuloid){
		$data['title'] = 'Detalle de Artículo';
		$data['active'] = 1; //punto 2 del sidebar
		//Obtener la lista de articulos
		$data['articulo'] = $this->cila_model->getarticulos($articuloid);
		$this->loadview('verarticulo',$data);

	}

	public function editarticulo($articuloid = NULL){
		$data['title'] = 'Detalle de Artículo ' . $articuloid;
		$data['active'] = 2; //punto 2 del sidebar
		//Obtener la lista de articulos
		$data['articulo'] = $this->cila_model->getarticulos($articuloid);
		
		$this->form_validation->set_rules('articuloprecio','Precio','required');

		if ($this->form_validation->run() === FALSE){
			$this->loadview('editararticulo',$data);
		}else{
			//subir la imagen
			/*
			$filename = '';
			if (isset($_FILES['articuloimg'])){

				$config['upload_path'] = './img/products/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size'] = 2000;
				$config['max_width'] = 1500;
				$config['max_height'] = 1500;
				
				$new_name = time().$_FILES["articuloimg"]['name'];
				$config['file_name'] = $new_name;
	
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('articuloimg')) {
					$error = array('error' => $this->upload->display_errors());
					$this->loadview('nuevoarticulo', $error);	
				}else{
					$metadata = $this->upload->data();
					$filename=$metadata['file_name'];
				}
			}*/
			$filename = '';
			$this->cila_model->edit_articulo($filename);
			redirect(base_url('index.php/cila/articulos'));
		}


	}

	public function deletearticulo($articuloid){
		//$articuloid = $_POST['articuloid'];
		//eliminar el registro
		$this->cila_model->del_articulo($articuloid);
		echo 'Eliminado ' . $articuloid;
	}
//////////////////////////////////////
// Carrito de Compra
//////////////////////////////////////


	public function view_cart(){
		//Devuelve el carrrtio
		$data['title'] = 'Detalle de la Compra';
		$data['active'] = 1; //punto 2 del sidebar
		//Obtener carrito
		$userid = $_SESSION['logged_in']['userid'];
		$data['carrito'] = $this->cila_model->get_carrito($userid);
		$this->loadview('shop-cart',$data);

	}

	public function add_to_cart($userid,$articulo, $cantidad){
		//Obtener el usuario logueado
		$this->cila_model->set_carrito($userid, $articulo, $cantidad);
		return 'Ok';
	}

	public function del_to_cart($carritoitem){
		$this->cila_model->del_carrito($carritoitem);
		return 'Ok';
	}

	public function clear_cart($userid){
		$this->cila_model->clear_carrito($userid);
		return 'Ok';
	}
}

?>