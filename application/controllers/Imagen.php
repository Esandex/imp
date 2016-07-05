<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagen extends CI_Controller {

	function __construct(){
		parent::__construct();	
		$this->load->model('Imagenes_model');
	}
	public function index()
	{

	}
	public function thumbnail($id)
	{
		$datos['imagen'] = $this->Imagenes_model->read($id);
		$thumbnail = $datos['imagen']->thumbnail;
		$tipo = 'image/jpg';
		header("Content-type: $tipo");
    	echo $thumbnail;
	}
	public function original($id)
	{
		$datos['imagen'] = $this->Imagenes_model->read($id);
		$original = $datos['imagen']->original;
		$tipo = $datos['imagen']->tipo_imagen;
		header("Content-type: $tipo");
    	echo $original;
	}
}
