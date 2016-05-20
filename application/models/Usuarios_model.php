<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//Aqui vamos a realizar el CRUD (create, read, update, delete)
	function obtenerUsuario($data){
		$this->db->where('USERNAME', $data['username']);
		$this->db->where('PASSWORD', $data['password']);
		$consulta = $this->db->get('users');
		$resultado = $consulta->row();
		return $resultado;
	}
	function user_menu($id)
	{
		$query = $this->db->query(
						"SELECT A.id_menu,
								A.description,
								A.url,
						        (SELECT B.checked
						         FROM user_menu AS B
						         WHERE 	B.id_menu = A.id_menu
						        	AND B.id_user = $id
						        ) AS checked
						FROM menus AS A"
						);
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function read_all(){
		$query = $this->db->get('users');
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function read($id){
		$this->db->where('id_user', $id);
		$query = $this->db->get('users');
		$result = $query->row();
		if($query -> num_rows() > 0) return $result;
		else return false;
	}
	function listar_menu_permitidos($id_user)
	{
		$query = $this->db->query(
								  "SELECT A.id_menu,
										  B.description,
										  B.url
								   FROM user_menu AS A
								   INNER JOIN menus AS B
								   ON A.id_menu = B.id_menu
								   WHERE A.id_user = $id_user
								  "
						);
		if($query -> num_rows() > 0) return $query;
		else return false;
	}
	function insertar_permiso_menu($id_user, $id_menu){
		$data = array(
						'id_user' => $id_user,
						'id_menu' => $id_menu,
						'checked' => 1
					 );
		$this->db->insert('user_menu', $data);
	}
	function eliminar_permiso_menu($id_user, $id_menu){
		$this->db->query("DELETE FROM user_menu
						  WHERE id_user = $id_user
						  	AND id_menu = $id_menu");
	}
}