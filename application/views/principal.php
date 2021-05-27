<html lang="en">
<head>
    <meta base="<?php echo base_url(); ?>">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo Curso</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--<script src="../alertifyJS/alertify.min.js"></script>
    <link rel="stylesheet" href="../alertifyJS/css/alertify.min.css">
    <link rel="stylesheet" href="../alertifyJS/css/themes/default.min.css">
    <link rel="stylesheet" href="../alertifyJS/css/themes/semantic.min.css">
    <link rel="stylesheet" href="../alertifyJS/css/themes/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!--<link rel="stylesheet" href="../css/datepicker.css">-->
    
<!-- JavaScript -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<!--<script src="../js/bootstrap-datepicker.js"></script>
<script src="../js/bootstrap-datepicker.es.js"></script>
<script src="../js/moment.js"></script>-->

<!-- CSS -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
<!-- Default theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
<!-- Semantic UI theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
<!-- Bootstrap theme -->
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>

</head>
<style>
    .liMarcas, .liModelos, .liPedidos{
        color:gray;
    }
    .activo{

        color:black;
    }
    /* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Firefox */
input[type=number] {
  -moz-appearance: textfield;
}
    
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12" >
            
                
            
                <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
                    <a class="navbar-brand" href="#">Curso CI</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">

                            <li class="nav-item liMarcas">
                                <a class="nav-link active" href="<?php echo 'http://localhost/codeigniter/marcas' ?>">Marcas <span class="sr-only">(current)</span></a>
                                <!--<span class="btnMarcas mr-1" style="cursor:pointer;">Marcas</span>-->
                            </li>
                            <li class="nav-item liModelos">
                                <a class="nav-link" href="<?php echo 'http://localhost/codeigniter/modelos'?>">Modelos</a>
                                <!--<span class="btnModelos mr-1" style="cursor:pointer">Modelos</span>-->
                            </li>
                            <li class="nav-item liPedidos">
                                <a class="nav-link" href="<?php echo 'http://localhost/codeigniter/pedidos'?>">Pedidos</a>
                                <!--<span class="btnPedidos mr-1" style="cursor:pointer">Pedidos</span>-->
                            </li>
                        
                        </ul>
                    </div>
                </nav>
                    <br>
                    
                    <div id="contenido-principal">
                        <div class="container">
                            <div class="row">
                                
                            </div>
                        </div>
                    <?php 
                        //La funcion sin parametros de igual forma funcionaria ya que esta configurado globalmente
                        //echo validation_errors();
                        //echo validation_errors('<div class="alert alert-danger"><strong>Error! </strong>', '</div>');
                        /*echo validation_errors('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Error! </strong>', '<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');*/
                    ?>
                    
                    <div id="divMensajes"></div>

                    <?php if(isset($arrMensaje)){ 
                        foreach($arrMensaje as $mensaje){ ?>
                    <div id="mensaje" class="alert alert-<?php if($mensaje["intTipo"]==1) 
                                                        echo 'success'; 
                                                    else 
                                                        echo 'danger' ?> alert-dismissible fade show" role="alert">
                                                        
                                                        <?= $mensaje["strMensaje"]; ?>
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        </div>
                            
                    
                    <?php  
                        }
                    }
                        if(isset($strContenido))
                            echo $strContenido;
                    ?>
                    </div>

            </div>

            <div class="col-12" id="contenido">
                    
            </div>
            <?php
                // directorio actual
//echo getcwd() . "\n";
 

 

            ?>
        </div>
    </div>

    <!-- JavaScript Bundle with Popper -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    
</body>
</html>

<script>
var URLactual = window.location;
console.log(URLactual);
if(URLactual=="http://localhost/codeigniter/pedidos"){
    $(".liModelos a").removeClass("active");
    $(".liMarcas a").removeClass("active");
    $(".liPedidos a").addClass("active");
}else if(URLactual=="http://localhost/codeigniter/modelos"){
    $(".liMarcas a").removeClass("active");
    $(".liPedidos a").removeClass("active");
    $(".liModelos a").addClass("active");
    
}else if(URLactual=="http://localhost/codeigniter/marcas"){
    $(".liModelos a").removeClass("active");
    $(".liPedidos a").removeClass("active");
    $(".liMarcas a").addClass("active");
    
}
$(".btnModelos").on("click", function(){
    $.ajax({ url: "http://localhost/codeigniter/modelos/", 
    dataType: 'text',
    success: function(data) {
        console.log(data);
        $("#contenido").html("");
        $("#contenido").html(data);
        $("#contenido-principal").html("");
        $("#navbar").hide();
        $(".liMarcas").removeClass("activo");
        $(".liPedidos").removeClass("activo");
        $(".liModelos").addClass("activo");
        
        history.pushState(null, "", "http://localhost/codeigniter/modelos/");
        
    }, 
    error: function() {
        alert("error"); 
    }
    });
});

$(".btnMarcas").on("click", function(){
    $.ajax({ url: "http://localhost/codeigniter/marcas/", 
    dataType: 'text',
    success: function(data) {
        $("#contenido").html("");
        $("#contenido").html(data);
        $("#contenido-principal").html("");
        $("#navbar").hide();
        $(".liModelos").removeClass("activo");
        $(".liPedidos").removeClass("activo");
        $(".liMarcas").addClass("activo");
        history.pushState(null, "", "http://localhost/codeigniter/marcas/");
    }, 
    error: function() {
        alert("error"); 
    }
    });
});

$(".btnPedidos").on("click", function(){
    $.ajax({ url: "http://localhost/codeigniter/pedidos/", 
    dataType: 'text',
    success: function(data) {
        console.log(data);
        $("#contenido").html("");
        $("#contenido").html(data);
        $("#contenido-principal").html("");
        $("#navbar").hide();
        $(".liModelos").removeClass("activo");
        $(".liMarcas").removeClass("activo");
        $(".liPedidos").addClass("activo");
        history.pushState(null, "", "http://localhost/codeigniter/pedidos/");
    }, 
    error: function() {
        alert("error"); 
    }
    });
});




</script>
