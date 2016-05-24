<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

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
		$this->load->view('productos/listar');
		$this->load->view('template/fin_panel');
	}
	public function nuevo()
	{
		$data = array();
		$data['username'] = $this->session->userdata('username');
		$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
		$this->load->view('template/inicio_panel', $data);
		$this->load->view('productos/nuevo');
		$this->load->view('template/fin_panel');
	}
	public function insertar()
	{
		$config['upload_path'] = 'template/images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width'] = '1024';
		$config['max_height'] = '768';
		if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
		$this->upload->initialize($config);
		$data = array(	
						'name' 			=> $this->input->post('name'), 
						'description' 	=> $this->input->post('description'),
						'username' 		=> $this->session->userdata('username')
					 );
		if (!$this->upload->do_upload('image'))
		{
			$upload_error = array('error' => $this->upload->display_errors());
            var_dump($upload_error);
		}else{
			$upload = array('image' => $this->upload->data());
			$im = file_get_contents($upload['image']['full_path']);
			$imdata = base64_encode($im);
			$data['image64'] = $imdata;
			unlink($upload['image']['full_path']);
		}
		//echo "<img src='data:image/jpeg;base64,".$imdata."'  />";
		$this->Productos_model->create($data);
		redirect('productos');
	}
}
