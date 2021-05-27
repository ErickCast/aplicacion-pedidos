<?php

    class Marcas extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model("MdlMarcas");
            

        }

        public function index($arrDatos=[]){
            
            
            $arrDatosLista["arrMarcas"] = $this->MdlMarcas->listar();
            foreach($arrDatosLista["arrMarcas"] as $marca){
                $marca->strId=$this->encrypt->encode($marca->id);
                //$marca->strId=$marca->id;
                
            }
            
            $arrDatos["strActivo"]="marcas";
            $arrDatos["strContenido"]=$this->load->view("marcas/listar", $arrDatosLista, TRUE);
            $this->load->view("principal.php", $arrDatos);
        }
        public function agregar($arrDatos=[]){
            
            $arrDatos["strActivo"]="marcas";
            $arrDatos["strContenido"]=$this->load->view("marcas/agregar", NULL, TRUE);
            $this->load->view("principal.php", $arrDatos);
        }
        public function guardar($arrDatos=[]){
            $intId = $this->input->post("intId");
            $nombre = $this->input->post("strNombre");
            
            //var_dump(strlen($nombre));
            //die();
            $arrDatosLista["arrMarcas"] = $this->MdlMarcas->listar();
            
            if($intId=="" || (strlen($nombre)>0)){
                $this->form_validation->set_rules(
                    'strNombre', 'Nombre',
                    'required|is_unique[marcas.nombre]',
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
                            'required'      => 'El %s es requerido',
                            'is_unique'     => 'El %s ya existe, ingrese otro'
                    )
                );
            }
            foreach($arrDatosLista["arrMarcas"] as $marca){
                
                if($marca->id == $intId){
                    $this->form_validation->set_rules(
                        'strNombre', 'Nombre',
                        'required',
                        array(
                                'required'      => 'El %s es requerido'
                                
                        )
                    );
                }
            }

            

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
                    $this->agregar();
                }else{
                    $this->editar($intId, TRUE);
                }
                
            }
            else
            {
                
                $strNombre = $this->input->post("strNombre");
                $strDescripcion = $this->input->post("strDescripcion");
                $intStatus = $this->input->post("intStatus");
                
                $intResultado=0;
                if($intId == ""){
                    $intResultado=$this->MdlMarcas->agregar($strNombre, $strDescripcion, $intStatus);
                }else{
                    $intResultado=$this->MdlMarcas->editar($intId, $strNombre, $strDescripcion, $intStatus);
                }
    
                if($intResultado==1){
                    //echo "El registro se guardo correctamente!!!";
                    $arrDatos["arrMensaje"]=[array("intTipo" => 1, //Success
                                                  "strMensaje" => "El registro se guardo correctamente!!!")];
                    $this->index($arrDatos);
                }else{
                    $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                                                  "strMensaje" => "No se pudo guardar el registro, intentalo de nuevo!!!")];
                   $this->agregar($arrDatos);
                }
                
            }

            

            
        }

        public function editar($intId=0, $EsEditarGuardar = FALSE){
            $strId=$this->input->post("strId");
            if(($strId!=="" && $this->encrypt->decode($strId) != "") || $intId!==0){
                if($intId==0){
                    $intId=$this->encrypt->decode($strId);
                }
                
            if(!$EsEditarGuardar){
                $arrDatos["registro"]=$this->MdlMarcas->buscar($intId);
            }
            
            $arrDatos["strActivo"]="marcas";
            $arrDatos["strContenido"]=$this->load->view("marcas/agregar", $arrDatos, TRUE);
            $this->load->view("principal.php", $arrDatos);
            }else{
                $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                    "strMensaje" => "Edite correctamente un registro")];
            
                $this->index($arrDatos);
            }
            
        }

        public function borrar(){
            $strId=$this->input->post("strId");
            if($strId!==""){
                $intId=$this->encrypt->decode($strId);
                $this->load->model("MdlModelos");
                $intTieneModelos=$this->MdlModelos->contarPorMarcaId($intId);
                if($intTieneModelos==0){

                
                    if($this->MdlMarcas->borrar($intId)==1){
                        $arrDatos["arrMensaje"]=[array("intTipo" => 1, //Success
                        "strMensaje" => "El registro se elimino correctamente!!!")];
        
                    }else{
                        $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                        "strMensaje" => "El registro no se pudo eliminar :(")];
        
                    }
                }else{
                    $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                        "strMensaje" => "La marca cuenta con registros, eliminelos primero!")];
                }
            }else{
                $arrDatos["arrMensaje"]=[array("intTipo" => 2, //Danger
                    "strMensaje" => "Elimine correctamente un registro")];
            }
            
            $this->index($arrDatos);
        }
    }

?>