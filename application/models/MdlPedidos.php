<?php
class MdlPedidos extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function listar(){
        $this->db->select("id, nombre, apellido, domicilio, telefono, monto, fecha, estado");
        $this->db->from("pedidos");
        $consulta = $this->db->get();
        return $consulta->result();
    }
    public function guardar($nombre, $apellido, $domicilio, $telefono, $estatus, $iva, $monto){
        $this->db->set("nombre", $nombre);
        $this->db->set("apellido", $apellido);
        $this->db->set("domicilio", $domicilio);
        $this->db->set("telefono", $telefono);
        //$this->db->set('fecha','NOW()', FALSE);
        $this->db->set("estado", $estatus);
        $this->db->set("iva", $iva);
        $this->db->set("monto", $monto);
        $this->db->insert("pedidos");
        return $this->db->affected_rows();
    }
    
    public function cambiarEstado($id, $estado){
        $this->db->set("estado", $estado);
        $this->db->where('id', $id);
        $this->db->update('pedidos'); 
        return $this->db->affected_rows();
    }

    public function editar($intPedidoId, $nombre, $apellido, $domicilio, $telefono, $estatus, $monto){
        $this->db->set("nombre", $nombre);
        $this->db->set("apellido", $apellido);
        $this->db->set("domicilio", $domicilio);
        $this->db->set("telefono", $telefono);
        $this->db->set("estado", $estatus);
        $this->db->set("monto", $monto);
        $this->db->where("id", $intPedidoId);
        $this->db->update("pedidos");
        return ($this->db->affected_rows() or count($this->db->error()) != 0);
    }
    public function filtrarPorFecha($fechaInicial, $fechaFinal){
        $this->db->select("id, nombre, apellido, domicilio, telefono, monto, fecha, estado");
        $this->db->where("fecha BETWEEN '$fechaInicial 00:00:00' AND '$fechaFinal 23:59:59'");
        $this->db->from("pedidos");
        $consulta = $this->db->get();
        return $consulta->result();
    }
    public function obtenerPedido($id){
        $this->db->select("id, nombre, apellido, domicilio, telefono, iva, monto, fecha, estado");
        $this->db->from("pedidos");
        $this->db->where("id", $id);
        $consulta = $this->db->get();
        return $consulta->result();
    }

    public function ultimoPedido(){
        $this->db->select("id");
        $this->db->from("pedidos");
        $this->db->order_by("id", "desc");
        $this->db->limit(1);
        $consulta = $this->db->get();
        return $consulta->result();


    }

    public function borrar($intPedidoId){
        $this->db->where("id", $intPedidoId);
        $this->db->delete("pedidos");
        return ($this->db->affected_rows() or count($this->db->error()) == 0);
    }
}

?>