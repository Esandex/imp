<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	//Aqui vamos a realizar el CRUD (create, read, update, delete)
	function insertar($data)
	{
		$datos = array(
						'firts_name' 	=> $data['name'],
						'email' 		=> $data['email'],
						'confirm'		=> 0
					 );
		$this->db->insert('pre_register', $datos);
		$destino 	= 	"burngeek8@gmail.com";
		$desde 		= 	"From: no-reply@esandex.com\r\nContent-type: text/html\r\n";
		$asunto		= 	"Pre Registro a SVO";
		$mensaje 	= 	"<!DOCTYPE html>
						 <html>
							<head>
								<title></title>
								<meta charset='UTF-8' />
								<meta name='viewport' content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no'>
								<meta name='HandheldFriendly' content='true'>		
							</head>
							<body style='margin: 0; background: #efefef; overflow: hidden; padding: 0 20px; font-size: 18px;'>
								<div style='background: #9d3520; max-height: 45px;'>
									<img src='http://vo.joseluisrl.com/img/logoc.png' height='45'>
								</div>
								<div>
									<h1 style='color: #9d3520; font-size: 25px; font-weight: normal; '>¡Tu cuenta de <strong style='color: #9d3520;'> SISVO </strong> ya está casi lista! </h1>
									<p>Tu correo es <strong style='color: #9d3520;'>".$data['email']."</strong></p>
									<p>Ahora lo que necesitas es un <strong style='color: #9d3520;'>Usuario </strong>y una <strong style='color: #9d3520;'>Contraseña</strong>, da clic al enlace para crear tu usuario.</p>
									<a href='http://vo.joseluisrl.com/confirmar-cuenta?email=".$data["email"]."'' style='cursor: pointer; background: #9d3520; text-decoration: none; border-radius: 5px; color: #e9e9e9; font-weight: bolder; padding: 10px 50px;'>Crear usuario</a>
									<p>Gracias <br /> El equido de Esandex</p>
								</div>
								<div style='background: #9d3520; color: #e9e9e9; height: 45px;'>
									<p style='line-height: 45px; text-align: center;'>SISVO de Esandex - 2015</p>
								</div>
							</body>
						 </html>";
		mail($destino,$asunto,$mensaje,$desde);
	}
}