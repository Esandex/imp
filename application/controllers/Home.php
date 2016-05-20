<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Usuarios_model');
	}
	public function index()
	{
		if($this->session->userdata('logueado')){
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('home');
			$this->load->view('template/fin_panel');
		}else{
			redirect('login');
		}
	}
	public function cerrar_sesion()
	{
		$usuario_data = array(
         'logueado' => FALSE
		);
		$this->session->set_userdata($usuario_data);
		redirect(base_url());
	}
}
