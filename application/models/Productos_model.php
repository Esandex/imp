<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function create($data){
		$now = date('Y-m-d H:m:s'); 
		$data = array(
						'product_name' 			=> $data['name'],
						'product_description' 	=> $data['description'],
						'product_image'			=> $data['imagen_id'],
						'date_update'			=> $now,
						'username_register' 	=> $data['username']
					 );
		$this->db->insert('products', $data);
	}
	function read_all(){
		$query = $this->db->get('products');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function read($id){
		$this->db->where('product_id', $id);
		$query = $this->db->get('products');
		$result = $query->row();
		if($query -> num_rows() > 0) return $result;
		else return false;
	}
}