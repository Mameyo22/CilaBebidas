<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cila extends CI_Controller{

    public function index(){
        $this->loadview('index.php');
    }

    public function loadview($view = NULL){
        $this->load->view('header.php');
        $this->load->view('sidebar.php');
        if (is_null($view)){
            $this->load->view('index.php');
        }else{
            $this->load->view($view);
        }
        $this->load->view('footer.php');
    }
}

?>