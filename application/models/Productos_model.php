<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function create(){

		$carpeta = base_url()."template/images/";
		opendir($carpeta);
		$destino = $carpeta.$_FILES['image']['name'];	
		copy($_FILES['image']['tmp_name'], $destino);
		//$im = file_get_contents($destino);
		//$imdata = base64_encode($im);
		//$id_usuario = $_POST['id_usuario']; 
		//unlink($destino);
		
	}
	function read_all(){
		$query = $this->db->get('products');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
}