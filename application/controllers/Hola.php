<?php

    class Hola extends CI_Controller{
        public $hola="";
        public function __construct(){
            parent::__construct();
            $this->hola="Hola mundo";
        }
        public function index(){
            $data["strHola"]=$this->hola;
            $data["strEjemplo"]=100;
            $vista = $this->load->view("hola", $data, TRUE);
            echo $vista;
            //echo "<a href='index.php'>Ir al inicio</a>";
        }

        public function dos(){
            echo "<h2>Aprendiendo CodeIgniter</h2>";
            echo $this->hola;
        }
        
        public function saludo($nombre = "Erick"){
            $datos["nombre"]=$nombre;
            //Al cargar una vista si le agregamos el parametro true se retorna, si no lo agregamos se hace un echo
            $this->load->view("saludo", $datos);
            
        }
    }
    
?>