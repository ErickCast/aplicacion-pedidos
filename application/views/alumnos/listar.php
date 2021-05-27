<h1>Lista de alumnos</h1>
<ul>
    <?php
        /*for($i=1;$i<=$cantidad;$i++){
            echo '<li>'.(${"nombre".$i}).' / '.${"apellido".$i}.' / '.${"edad".$i}.'</li>';
            
            
        }*/

        foreach($datos as $key => $value){
            echo '<li>'.$value["nombre"].' / '.$value["apellido"].' / '.$value["edad"].'</li>';
        }
    ?>
</ul>