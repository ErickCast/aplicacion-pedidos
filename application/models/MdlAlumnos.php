<?php

class MdlAlumnos extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    public function obtenerAlumnos(){
       $arr = [array("nombre" => "Erick",
                      "apellido" => "Castillo",
                      "edad" => 22),
                array("nombre" => "Karen",
                      "apellido" => "Lopez",
                      "edad" => 21),
                array("nombre" => "Jorge",
                      "apellido" => "Ramirez",
                      "edad" => 34)
    ];

        return $arr;

    }
}

?>