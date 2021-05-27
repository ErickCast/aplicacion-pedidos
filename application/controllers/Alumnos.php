<?php

    class Alumnos extends CI_Controller{
        public function __construct(){
            parent::__construct();
        }

        public function listar(){
            $this->load->model("MdlAlumnos");
            $contador=0;
            $datos=$this->MdlAlumnos->obtenerAlumnos();
            /*for($i=0;$i<count($datos);$i++){
                $dataArray["nombre".($i+1)]=$datos[$i]["nombre"];
                $dataArray["apellido".($i+1)]=$datos[$i]["apellido"];
                $dataArray["edad".($i+1)]=$datos[$i]["edad"];
                $dataArray["cantidad"]=$i+1;
            }*/

            $dataArray["datos"]=$datos;
            
            $this->load->view("alumnos/listar", $dataArray);
        }
    }

?>