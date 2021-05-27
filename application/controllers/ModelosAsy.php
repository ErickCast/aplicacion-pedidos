<?php

    class Modelos extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model("MdlModelos");
        }

        public function index($arrDatos=[]){
            $intMarcaId=$this->input->post("intMarcaId");
            if($intMarcaId==""){
                $intMarcaId=0;
            }
            $this->load->model("MdlMarcas");
            $arrDatosLista["arrMarcas"]=$this->MdlMarcas->buscarActivos();
            $arrDatosLista["arrModelos"]=$this->MdlModelos->listar($intMarcaId);
            $arrDatosLista["intMarcaId"]=$intMarcaId;
            foreach($arrDatosLista["arrModelos"] as $modelo){
                $modelo->strId=$this->encrypt->encode($modelo->id);
            }
            if(isset($arrDatos["arrMensajes"]) && $arrDatos["arrMensajes"][0]["intTipo"]==1){
                $arrDatosLista["intExito"]=1;
            }else{
                $arrDatosLista["intExito"]=0;
            }
            if(isset($arrDatos["registro"])){
                $arrDatosLista["registro"] = $arrDatos["registro"];
            }

            $arrDatos["strActivo"]="modelos";
            $arrDatos["strContenido"]=$this->load->view("modelos/listar", $arrDatosLista, TRUE);
            $this->load->view("principal.php", $arrDatos);
        }

        public function guardar(){
            $intId = $this->input->post("intId");
            $nombre = $this->input->post("strNombre");
            
            //var_dump(strlen($nombre));
            //die();
            $arrDatosLista["arrMarcas"] = $this->MdlModelos->listar($intId);
            
            if($intId==""){
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre',
                    'required|is_unique[modelos.nombre]',
                    array(
                            'required'      => 'El %s es requerido',
                            'is_unique'     => 'El %s ya existe, ingrese otro'
                    )
                );
            }else{
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre',
                    'required',
                    array(
                            'required'      => 'El %s es requerido'
                    )
                );
            }

            $this->form_validation->set_rules(
                'intMarcaId', 'Marca',
                'required|integer',
                array(
                        'required'      => 'Seleccione un %s',
                        'integer'     => 'El %s debe de ser un numero'
                )
            );

            /*foreach($arrDatosLista["arrMarcas"] as $marca){
                
                if($marca->id == $intId){
                    $this->form_validation->set_rules(
                        'strNombre', 'Nombre',
                        'required',
                        array(
                                'required'      => 'El %s es requerido'
                                
                        )
                    );
                }
            }*/

            

            $this->form_validation->set_rules(
                'intStatus', 'Status',
                'required|integer|greater_than[0]',
                array(
                        'required'      => 'El %s es requerido',
                        'integer'     => 'El %s debe ser un numero',
                        'greater_than' => 'Debes elegir una opcion para %s'
                )
            );

            
            
            if ($this->form_validation->run() == FALSE)
            {
                if($intId==""){
                    $this->index();
                    
                }else{
                    $this->editar($intId, TRUE);
                }
                
            }
            else
            {
                $intMarcaId = $this->input->post("intMarcaId");
                $strNombre = $this->input->post("strNombre");
                $strDescripcion = $this->input->post("strDescripcion");
                $intStatus = $this->input->post("intStatus");
                
                $intResultado=0;
                if($intId == ""){
                    $intResultado=$this->MdlModelos->agregar($intMarcaId, $strNombre, $strDescripcion, $intStatus);
                }else{
                    $intResultado=$this->MdlModelos->editar($intId, $strNombre, $strDescripcion, $intStatus);
                }
                
               
                if($intResultado==1){
                    //echo "El registro se guardo correctamente!!!";
                    $arrDatos["arrMensaje"]=[array("intTipo" => 1, //Success
                                                  "strMensaje" => "El registro se guardo correctamente!!!")];
                   
                }else{
                    $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                                                  "strMensaje" => "No se pudo guardar el registro, intentalo de nuevo!!!")];
                   
                }
                
                $this->index($arrDatos);
            }

            

            
        }

        public function editar($intId=0, $EsEditarGuardar = FALSE){
            $arrDatos=[];
            $strId=$this->input->post("strId");
            if(($strId!=="" && $this->encrypt->decode($strId) != "") || $intId!==0){
                if($intId==0){
                    $intId=$this->encrypt->decode($strId);
                }
                
            if(!$EsEditarGuardar){
                $arrDatos["registro"]=$this->MdlModelos->buscar($intId);
            }
            
            
            }else{
                $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                    "strMensaje" => "Edite correctamente un registro")];
            
                
            }
            $this->index($arrDatos);
            
        }

        public function borrar(){
            $strId=$this->input->post("strId");
            if($strId!==""){
                $intId=$this->encrypt->decode($strId);
                if($this->MdlModelos->borrar($intId)==1){
                    $arrDatos["arrMensaje"]=[array("intTipo" => 1, //Success
                    "strMensaje" => "El registro se elimino correctamente!!!")];
    
                }else{
                    $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                    "strMensaje" => "El registro no se pudo eliminar :(")];
    
                }
            }else{
                $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                    "strMensaje" => "Elimine correctamente un registro")];
            }
            
            $this->index($arrDatos);
        }
    }

?>