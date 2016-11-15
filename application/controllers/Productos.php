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
			$this->load->model('Imagenes_model');
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
	public function editar($id)
	{
		if($id){
			$data = array();
			$data['username'] = $this->session->userdata('username');
			$data['menus_permitidos'] = $this->Usuarios_model->listar_menu_permitidos($this->session->userdata('id'));
			$data['product'] = $this->Productos_model->read($id);
			$this->load->view('template/inicio_panel', $data);
			$this->load->view('productos/editar');
			$this->load->view('template/fin_panel');
		}else{
			redirect('productos');
		}
	}
	public function insertar()
	{
		$config['upload_path'] = 'template/images/';
		$config['allowed_types'] = '*';
		$config['max_size']	= '16384';
		//$config['max_width'] = '1024'; 
		//$config['max_height'] = '768';
		if ( ! is_dir($config['upload_path']) ) die("THE UPLOAD DIRECTORY DOES NOT EXIST");
			$this->upload->initialize($config);
			$data = array(	
							'name' 			=> $this->input->post('name'), 
							'description' 	=> $this->input->post('description'),
							'username' 		=> $this->session->userdata('username')
						 );
		if (!$this->upload->do_upload('image'))
		{
			$data['upload_error'] = $this->upload->display_errors();
            $this->load->view('template/inicio_panel', $data);
            $this->load->view('error.php');
            $this->load->view('template/fin_panel');
		}else{
			$upload = array('image' => $this->upload->data());
			$ruta_imagen = $upload['image']['full_path'];
			$miniatura_ancho_maximo = 200;
			$miniatura_alto_maximo = 200; 

			$info_imagen = getimagesize($ruta_imagen);
			$imagen_ancho = $info_imagen[0];
			$imagen_alto = $info_imagen[1];
			$imagen_tipo = $info_imagen['mime'];


			$proporcion_imagen = $imagen_ancho / $imagen_alto;
			$proporcion_miniatura = $miniatura_ancho_maximo / $miniatura_alto_maximo;

			if ( $proporcion_imagen > $proporcion_miniatura ){
				$miniatura_ancho = $miniatura_ancho_maximo;
				$miniatura_alto = $miniatura_ancho_maximo / $proporcion_imagen;
			} else if ( $proporcion_imagen < $proporcion_miniatura ){
				$miniatura_ancho = $miniatura_ancho_maximo * $proporcion_imagen;
				$miniatura_alto = $miniatura_alto_maximo;
			} else {
				$miniatura_ancho = $miniatura_ancho_maximo;
				$miniatura_alto = $miniatura_alto_maximo;
			}


			switch ( $imagen_tipo ){
				case "image/jpg":
					$imagen = imagecreatefromjpeg( $ruta_imagen );
					break;
				case "image/jpeg":
					$imagen = imagecreatefromjpeg( $ruta_imagen );
					break;
				case "image/png":
					$imagen = imagecreatefrompng( $ruta_imagen );
					break;
				case "image/gif":
					$imagen = imagecreatefromgif( $ruta_imagen );
					break;
			}

			$lienzo = imagecreatetruecolor( $miniatura_ancho, $miniatura_alto );

			imagecopyresampled(	$lienzo, $imagen, 0, 0, 0, 0, $miniatura_ancho, 
								$miniatura_alto, 
								$imagen_ancho, $imagen_alto);
			imagejpeg($lienzo, "template/images/miniatura.jpg", 80);
			//imagen original 
			$fp = fopen($ruta_imagen, 'r');
        	$original = fread($fp, filesize($ruta_imagen));
        	fclose($fp);
    		$data['original'] = $original;
    		$data['tipo_imagen'] = $imagen_tipo;
    		unlink($ruta_imagen);
    		//miniatura
			$miniatura = "template/images/miniatura.jpg";
    		$fp = fopen($miniatura, 'r');
        	$thumbnail = fread($fp, filesize($miniatura));
        	fclose($fp);
    		$data['thumbnail'] = $thumbnail;
    		$now = date('YmdHms'); 
        	$data['imagen_id'] = md5($now);
        	unlink($miniatura);
    		//insertar imagenes en binario
    		$this->Imagenes_model->create($data);
    		$this->Productos_model->create($data);
			redirect('productos');
		}
		//echo "<img src='data:image/jpeg;base64,".$imdata."'  />";
		//echo "<img src='data:image/jpeg;base64,".$minidata."'  />";
		
	}
}
