<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('home');
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
