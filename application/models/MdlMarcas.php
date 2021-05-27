<?php

class MdlMarcas extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function listar(){
        
        
        /*$consulta = $this->db->query("SELECT id,nombre,
        CASE status 
        WHEN 1 THEN 'Activo' 
        WHEN 2 THEN 'Cancelado' 
        ELSE 'Otro'
        END AS status FROM marcas");*/
        //var_dump($consulta->result_array()); - Esto nos retorna un Array
        /*var_dump($consulta->result()); // Esto nos retorna un objeto
        $listado = $consulta->result();
        foreach($listado as $key => $value){
            echo "Este es el: ". $key."<br>";
            var_dump($value);
        }*/
        $this->db->select("id,nombre, descripcion, 
        CASE status 
        WHEN 1 THEN 'Activo' 
        WHEN 2 THEN 'Cancelado' 
        ELSE 'Otro'
        END AS status");
        $this->db->from("marcas");
        $consulta = $this->db->get();
        return $consulta->result();

    }

    //Esta funcion retorna un entero
    public function agregar($strNombre, $strDescripcion, $intStatus){
        $this->load->database();
        //$strSentencia="INSERT INTO marcas(nombre, descripcion, status) VALUES('$strNombre', '$strDescripcion', $intStatus)";
        $this->db->set("nombre", $strNombre);
        $this->db->set("descripcion", $strDescripcion);
        $this->db->set("status", $intStatus);
        $this->db->insert("marcas");
        return $this->db->affected_rows();
    }

    public function editar($intId, $strNombre, $strDescripcion, $intStatus){
        $this->db->set("nombre", $strNombre);
        $this->db->set("descripcion", $strDescripcion);
        $this->db->set("status", $intStatus);
        $this->db->where("id", $intId);
        $this->db->update("marcas");
        return ($this->db->affected_rows() or count($this->db->error()) != 0);
    }
    public function buscar($intId){
        $this->db->select("id,nombre,descripcion,status");
        $this->db->from("marcas");
        $this->db->where("id", $intId);
        $consulta = $this->db->get();
        return $consulta->row();
    }
    public function borrar($intId){
        $this->db->where("id", $intId);
        $this->db->delete("marcas");
        return ($this->db->affected_rows() or count($this->db->error()) != 0);
    }

    public function buscarActivos(){
        
        
        
        $this->db->select("id,nombre");
        $this->db->from("marcas");
        $this->db->where("status", 1); //1 = activo 2 = cancelado
        $consulta = $this->db->get();
        return $consulta->result();

    }
}

?>
