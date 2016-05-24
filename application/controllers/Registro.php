<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model('Registro_model');
		$this->load->model('Usuarios_model');
	}
	public function index()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('template/fin_panel');
	}
	public function token($token)
	{
		$data = array();
		$data['registro'] = $this->Registro_model->read($token);
		$this->load->view('confirmar-usuario', $data);
	}
	public function crear($token)
	{
		$registro = $this->Registro_model->read($token);
		$avatar = 'template/images/hombre.jpg';
		$im = file_get_contents($avatar);
		$imdata = base64_encode($im);		
		$data = array(	
						'firts_name' 	=> $registro->firts_name,
						'username' 		=> $this->input->post('username'), 
						'password' 		=> $this->input->post('password'),
						'email'			=> $registro->email,
						'image64'		=> $imdata
					 );
		$this->Registro_model->create($data);
		$ResultSet = $this->Usuarios_model->obtenerUsuario($data);
		if($ResultSet){
			$usuario_data = array(
               'id' => $ResultSet->id_user,
               'username' => $ResultSet->USERNAME,
               'logueado' => TRUE
            );
            $this->session->set_userdata($usuario_data);
            redirect(base_url()."panel");
		}else{
			redirect(base_url()."");	
		}
	}
}
