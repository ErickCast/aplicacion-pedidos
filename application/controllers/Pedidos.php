<?php

class Pedidos extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model("MdlPedidos");
    }

    public function index($arrDatos=[]){
        $intMarcaId=0;
        $arrDatosLista["arrPedidos"]=$this->MdlPedidos->listar();
        $this->load->model("MdlMarcas");
        $this->load->model("MdlModelos");
        $arrDatosLista["arrMarcas"]=$this->MdlMarcas->buscarActivos();
        //$arrDatosLista["arrModelos"]=$this->MdlModelos->listar($intMarcaId);
        $arrDatos["strContenido"]=$this->load->view("pedidos", $arrDatosLista, TRUE);
        $this->load->view("principal.php", $arrDatos);

        
    }

    public function obtenerPorFecha($arrDatos=[]){
        $fechaInicial=$this->input->post("fechaInicial");
        $fechaFinal=$this->input->post("fechaFinal");
        $arrDatos["arrPedidos"]=$this->MdlPedidos->filtrarPorFecha($fechaInicial, $fechaFinal);
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arrDatos));

    }

    public function sacarOrdenes($id_pedido){
        $this->load->model("MdlOrdenes");

        $arrDatos["arrOrdenes"]=$this->MdlOrdenes->obtenerOrdenes($id_pedido);
        
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arrDatos));
    }

    public function obtenerPedido($id){
        
        $this->load->model("MdlModelos");
            $arrDatos["pedido"]=$this->MdlPedidos->obtenerPedido($id);
            
            $iva=$arrDatos["pedido"][0]->iva;
            //$productos=json_decode($arrDatos["pedido"][0]->productos);
            $i=0;
            $arrDatos["iva"]=$iva;
            $arrDatos["totalSubTotal"]=0;
            $arrDatos["totalMostrar"]=0;
            $arrDatos["totalIva"]=0;
            /*foreach($productos->productos as $key => $value){
                //var_dump($value[$i]["id"]);
                
                $id_pedido=$value->id;
                $cantidad_pedido=$value->cantidad;
                $modelo=$this->MdlModelos->obtenerModelosConMarca($id_pedido);
                
                
                $arrDatos["subTotal"][$i]=$modelo->precio*$cantidad_pedido;
                $arrDatos["totalPrecio"][$i]=($modelo->precio*$cantidad_pedido)+(($modelo->precio*$cantidad_pedido)*$iva);
                $arrDatos["diferenciaIva"][$i]=($modelo->precio*$cantidad_pedido)*0.16;
                $arrDatos["totalSubTotal"]+=$arrDatos["subTotal"][$i];
                $arrDatos["totalMostrar"]+=$arrDatos["totalPrecio"][$i];
                $arrDatos["totalIva"]+=$arrDatos["diferenciaIva"][$i];
                $i++;
                
            }*/

            $this->load->model("MdlOrdenes");

            $arrDatos["arrOrdenes"]=$this->MdlOrdenes->obtenerOrdenes($id);
            

            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arrDatos));
    }

    public function listar($arrDatos=[]){
        $intMarcaId=0;
        $arrDatosLista["arrPedidos"]=$this->MdlPedidos->listar();
        $this->load->model("MdlMarcas");
        $this->load->model("MdlModelos");
        $arrDatosLista["arrMarcas"]=$this->MdlMarcas->buscarActivos();
        //$arrDatosLista["arrModelos"]=$this->MdlModelos->listar($intMarcaId);
        $arrDatos["strContenido"]=$this->load->view("pedidos", $arrDatosLista, TRUE);
        $this->load->view("principal.php", $arrDatos);
        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arrDatosLista));
    }
    public function listarModelos($intMarcaId){
        $this->load->model("MdlModelos");
        $arrDatos["arrModelos"]=$this->MdlModelos->listar($intMarcaId);

        $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($arrDatos));
    }

    public function obtenerModeloYMarca($intModeloId){
        $this->load->model("MdlModelos");
        $modelo=$this->MdlModelos->obtenerModelosConMarca($intModeloId);
        $arrDatos["modelo"]=$modelo;
        $arrDatos["iva"]=0.16;

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arrDatos));

    }

    public function actualizarEstado(){
        $intId=$this->input->post("intId");
        $estado=$this->input->post("intEstado");


        $intResultado=$this->MdlPedidos->cambiarEstado($intId, $estado);

        if($intResultado==1){
            //echo "El registro se guardo correctamente!!!";
            $arrDatos["arrMensaje"]=[array("intTipo" => 1, //Success
                                          "strMensaje" => "El estado se actualizo correctamente!!!")];
           
        }else{
            $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                                          "strMensaje" => "No se pudo actualizar el estado, intentalo de nuevo!!!")];
           
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arrDatos));
    }

    public function guardar(){
        $intId = $this->input->post("intId");
        
        
        
        
        
        
        
            $nombre = $this->input->post("nombre");
            $apellido = $this->input->post("apellido");
            $domicilio = $this->input->post("domicilio");
            $telefono = $this->input->post("telefono");
            $estado = $this->input->post("estado");
            $ordenes=$this->input->post("ordenes");
            
        
            $ordenes_array=json_decode($ordenes, true);
            $arrDatos["ordenes_array"]=$ordenes_array;
            $iva =0.16;
            $monto = $this->input->post("monto");
            $this->load->model("MdlOrdenes");
            $intResultado=0;
            if($intId == ""){
                //Aplicar transactions
                $this->db->trans_begin();
                $this->MdlPedidos->guardar($nombre, $apellido, $domicilio, $telefono, $estado, $iva, $monto);
                $id_pedido=$this->MdlPedidos->ultimoPedido();
                $id=$id_pedido[0]->id;
                $arrDatos["exito"]=$this->MdlOrdenes->insertarOrden($id, $ordenes_array);

                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    $intResultado=0;
                }
                else
                {
                    $this->db->trans_commit();
                    $intResultado=1;
                }   
                
                
                
            }else{
                $this->db->trans_begin();
                $this->MdlPedidos->editar($intId, $nombre, $apellido, $domicilio, $telefono, $estado, $monto);
                $arrDatos["exito"]=$this->MdlOrdenes->editarOrden($intId, $ordenes_array);

                if ($this->db->trans_status() === FALSE)
                {
                    $this->db->trans_rollback();
                    $intResultado=0;
                }
                else
                {
                    $this->db->trans_commit();
                    $intResultado=1;
                }   

            }
            
           
            if($intResultado==1){
                //echo "El registro se guardo correctamente!!!";
                $arrDatos["arrMensaje"]=[array("intTipo" => 1, //Success
                                              "strMensaje" => "El registro se guardo correctamente!!!")];
               
            }else{
                $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                                              "strMensaje" => "No se pudo guardar el registro, intentalo de nuevo!!!")];
               
            }
            
             //$this->index($arrDatos);
        

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arrDatos));

        

        
    }

    public function eliminarPedido($intId){
        $marca=$this->MdlPedidos->borrar($intId);
        $this->load->model("MdlOrdenes");
        $this->MdlOrdenes->borrarOrdenes($intId);

        $arrDatos=[];
        if($marca==1){
            $arrDatos["arrMensaje"]=[array("intTipo" => 1, //Success
            "strMensaje" => "El pedido se elimino correctamente!!!")];

        }else{
            $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
            "strMensaje" => "El pedido no se pudo eliminar :(")];

        }
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($arrDatos));

            
    }

}