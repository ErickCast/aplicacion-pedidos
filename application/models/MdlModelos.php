<?php
class MdlModelos extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function listar($intMarcaId){
        
        $this->db->select("id, marca_id ,nombre, precio,
        CASE status 
        WHEN 1 THEN 'Activo' 
        WHEN 2 THEN 'Cancelado' 
        ELSE 'Otro'
        END AS status");
        $this->db->from("modelos");
        $this->db->where("marca_id", $intMarcaId);
        $consulta = $this->db->get();
        return $consulta->result();

    }

    public function agregar($intMarcaId, $strNombre, $strDescripcion, $dblPrecio, $intStatus){
        $this->db->set("marca_id", $intMarcaId);
        $this->db->set("nombre", $strNombre);
        $this->db->set("descripcion", $strDescripcion);
        $this->db->set("precio", $dblPrecio);
        $this->db->set("status", $intStatus);
        $this->db->insert("modelos");
        return $this->db->affected_rows();

    }

    public function editar($intModeloId, $strNombre, $strDescripcion,  $dblPrecio, $intStatus){
        $this->db->set("nombre", $strNombre);
        $this->db->set("descripcion", $strDescripcion);
        $this->db->set("precio", $dblPrecio);
        $this->db->set("status", $intStatus);
        $this->db->where("id", $intModeloId);
        $this->db->update("modelos");
        return ($this->db->affected_rows() or count($this->db->error()) != 0);
    }

    public function buscar($intModeloId){
        $this->db->select("id, nombre, descripcion, precio, status");
        $this->db->from("modelos");
        $this->db->where("id", $intModeloId);
        return $this->db->get()->row();
    }

    public function borrar($intModeloId){
        $this->db->where("id", $intModeloId);
        $this->db->delete("modelos");
        return ($this->db->affected_rows() or count($this->db->error()) == 0);
    }

    public function contarPorMarcaId($intMarcaId){
        $this->db->select("id");
        $this->db->from("modelos");
        $this->db->where("marca_id", $intMarcaId);
        return count($this->db->get()->result());
    }
    
    public function obtenerModelosConMarca($intModeloId){
        $this->db->select('mod.*,mar.nombre AS nombre_marca');
        $this->db->from('modelos mod');
        $this->db->join('marcas mar', 'mar.id = mod.marca_id');
        $this->db->where("mod.id", $intModeloId);
        return $this->db->get()->row();
    }
}

?>