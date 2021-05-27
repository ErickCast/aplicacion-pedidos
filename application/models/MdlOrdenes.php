<?php
class MdlOrdenes extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function insertarOrden($id_pedido, $ordenes){
        $data=array();
        $i=0;
        foreach($ordenes["productos"] as $orden){
            $data[$i]["cantidad"]=$orden["cantidad"];
            $data[$i]["modelo_id"]=$orden["id"];
            $data[$i]["pedido_id"]=$id_pedido;

            $i++;
        }

        
        

        
       

         $this->db->insert_batch('ordenes', $data);

         return $this->db->affected_rows();
        /*foreach($data as $value){
            $this->db->set("pedido_id", $value->pedido_id);
            $this->db
        }*/
    }

    public function editarOrden($id_pedido, $ordenes){
        //$this->db->trans_start(); # Starting Transaction
        //$this->db->trans_strict(TRUE); # See Note 01. If you wish can remove as well 
        $this->db->trans_begin();

        $this->borrarOrdenes($id_pedido);

        $data=array();
        $i=0;
        foreach($ordenes["productos"] as $orden){
            $data[$i]["cantidad"]=$orden["cantidad"];
            $data[$i]["modelo_id"]=$orden["id"];
            $data[$i]["pedido_id"]=$id_pedido;

            $i++;
        }

        
        

        
       

        $this->db->insert_batch('ordenes', $data);

        

         

        /*if ($this->db->trans_status() === FALSE) {
            # Something went wrong.
            $this->db->trans_rollback();
            return FALSE;
        } 
        else {
            # Everything is Perfect. 
            # Committing data to the database.
            $this->db->trans_commit();
            return TRUE;
        }*/
         
        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
        }
        else
        {
            $this->db->trans_commit();
        }


    }

    public function borrarOrdenes($id_pedido){
        $this->db->where("pedido_id", $id_pedido);
        $this->db->delete("ordenes");
        return ($this->db->affected_rows() or count($this->db->error()) == 0);
    }

    public function contarPorModeloId($id_modelo){
        $this->db->select("id");
        $this->db->from("ordenes");
        $this->db->where("modelo_id", $id_modelo);
        return count($this->db->get()->result());
    }
    

    public function obtenerOrdenes($id_pedido){
        $this->db->select("modelo_id, cantidad");
        $this->db->from("ordenes");
        $this->db->where("pedido_id", $id_pedido);
        $consulta = $this->db->get();
        return $consulta->result();

    }

    
    
}

?>