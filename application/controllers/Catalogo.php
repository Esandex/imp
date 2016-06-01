<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Catalogo extends CI_Controller {

	function __construct(){
		parent::__construct();	
		if(!$this->session->userdata('logueado')){			
			redirect('login');
		}else{
			$this->load->model('Usuarios_model');	
			$this->load->model('Productos_model');
		}
	}
	public function index()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$data['products'] = $this->Productos_model->read_all();
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('productos/catalogo');
		$this->load->view('template/fin_panel');
	}
}
