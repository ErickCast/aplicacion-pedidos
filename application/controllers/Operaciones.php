<?php
//Controlador de operaciones: suma, resta, multiplicacion y division
class Operaciones extends CI_Controller{
    public $resultado;
    public function __construct(){
        parent::__construct();
        echo "<h2>Controlador de Operaciones</h2>";
    }

    public function index(){
        echo "Hola mundo";
    }
    public function suma($valor1, $valor2){
        $this->resultado=$valor1 + $valor2;
        echo $this->resultado;
    }

    public function resta($valor1, $valor2){
        $this->resultado=$valor1 - $valor2;
        echo $this->resultado;
    }

    public function multiplicacion($valor1, $valor2){
        $this->resultado=$valor1 * $valor2;
        echo $this->resultado;
    }

    public function division($valor1, $valor2){
        $this->resultado=$valor1 / $valor2;
        echo $this->realizarDivision($valor1,$valor2);
        
    }

    public function realizarDivision($valor1, $valor2){
        return $valor1 / $valor2;
    }




}

?>