<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imagenes_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    function create($data)
    {
        
        $datos = array(
                        'imagen_id'          => $data['imagen_id'],
                        'original'           => $data['original'],
                        'thumbnail'          => $data['thumbnail'],
                        'tipo_imagen'        => $data['tipo_imagen'],
                        'username_register'  => $data['username']
                      );
        $this->db->insert('imagenes', $datos);   
    }   
    function read($id){
        $this->db->where('imagen_id', $id);
        $query = $this->db->get('imagenes');
        $result = $query->row();
        if($query -> num_rows() > 0) return $result;
        else return false;
    }
}