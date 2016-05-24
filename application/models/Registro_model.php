<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//Aqui vamos a realizar el CRUD (create, read, update, delete)
	function create($data)
	{
		$this->db->insert('users', array(	'firts_name'	=> $data['firts_name'],
											'username' 		=> $data['username'],
											'password' 		=> $data['password'],
											'email' 		=> $data['email'],
											'avatar'		=> $data['image64'],
											'category'		=> 1
										  )
						 );
	}
	function read($token)
	{
		$this->db->where('token', $token);
		$query = $this->db->get('pre_register');
		$result = $query->row();
		if($query -> num_rows() > 0) return $result;
		else return false;
	}
	function insertar($data)
	{
		$cadena = $data['email'];
		$token = md5($cadena);
		$datos = array(
						'firts_name' 		=> $data['name'],
						'email' 			=> $data['email'],
						'token'				=> $token,
						'confirm'			=> 0,
						'username_register'	=> $data['username']
					 );
		$this->db->insert('pre_register', $datos);
		$destino 	= 	$datos['email'].",burngeek8@gmail.com";
		$desde 		= 	"From: no-reply@esandex.com\r\nContent-type: text/html\r\n";
		$asunto		= 	"Pre Registro a IMP";
		$mensaje 	= 	"<!DOCTYPE html>
						 <html>
							<head>
								<title></title>
								<meta charset='UTF-8' />
								<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
								<meta name='HandheldFriendly' content='true'>		
							</head>
							<body style='margin: 0; background: #efefef; overflow: hidden; padding: 0 20px; font-size: 18px;'>
								<div style='background: #8e24aa; max-height: 45px;'>
									<img src='".base_url()."/template/images/logo.png' height='45'>
								</div>
								<div>
									<h1 style='color: #8e24aa; font-size: 25px; font-weight: normal; '>¡Tu cuenta de <strong style='color: #8e24aa;'> IMP </strong> ya está casi lista! </h1>
									<p>Tu correo es <strong style='color: #8e24aa;'>".$data['email']."</strong></p>
									<p>Ahora lo que necesitas es un <strong style='color: #8e24aa;'>Usuario </strong>y una <strong style='color: #8e24aa;'>Contraseña</strong>, da clic al enlace para crear tu usuario.</p>
									<a href='".base_url()."confirmar-usuario/".$token."' style='cursor: pointer; background: #8e24aa; text-decoration: none; border-radius: 5px; color: #e9e9e9; font-weight: bolder; padding: 10px 50px;'>Crear usuario</a>
									<p>Gracias <br /> El equido de IMP</p>
								</div>
								<div style='background: #8e24aa; color: #e9e9e9; height: 45px;'>
									<p style='line-height: 45px; text-align: center;'>IMP - 2016</p>
								</div>
							</body>
						 </html>";
		mail($destino,$asunto,$mensaje,$desde);
	}
}