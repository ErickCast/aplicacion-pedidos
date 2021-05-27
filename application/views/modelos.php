<?php
    //echo "Exito = $intExito <br>";
?>
<div id="mensaje"></div>
<div class="card">
  <h5 class="card-header">Modelos</h5>
  <div class="card-body">
    <form>
        <?php echo form_error('intMarcaId'); ?>
        <div class="form-group">
                <label for="cmbMarca">Marca</label>
                <select name="intMarcaId" id="cmbMarca" class="form-control cmbMarca" onchange="actualizarLista()">
                    <option value="0">[ Seleccione ]</option>
                    <?php 
            
                    foreach($arrMarcas as $key => $value){?>
                        
                        <option class="optMarca" value="<?=$value->id?>" <?php if($value->id == $intMarcaId) echo "selected" ?> ><?=$value->nombre?> </option>
                <?php   }
            ?>
                </select>
        </div>
    </form>
    <div class="row">
        <div class="col-2 col-sm-6 col-md col-lg-4">
            <div class="card">
                <h5 class="card-header" id="tituloAgregarEditar">Agregar Modelo</h5>
                <div class="card-body">
                    <h5 class="card-title">Listado de Modelos</h5>
                    <form>
                        <input type="hidden" name="intMarcaId" id="intMarcaId" value="<?=$intMarcaId?>">
                        <div class="form-group">
                            <label for="txtId">ID</label>
                            <input name="intId" type="text" class="form-control" id="txtIdMdl" placeholder="[Nuevo]" readonly="" value="<?php if($intExito) echo set_value('intId') ?><?php if(isset($registro)) echo $registro->id; ?>">
                            
                        </div>
                        <?php echo form_error('strNombre'); ?>
                        <div class="form-group">
                            <label for="txtNombre">Nombre</label>
                            <input name="strNombre" type="text" class="form-control" id="txtNombreMdl" placeholder="Ingrese el nombre" value="<?php if($intExito) echo set_value('strNombre'); ?><?php if(isset($registro)) echo $registro->nombre ?>">
                        </div>
                        <?php echo form_error('strDescripcion'); ?>
                        <div class="form-group">
                            <label for="txtNombre">Descripcion</label>
                            <textarea name="strDescripcion" class="form-control" id="txtDescripcionMdl" cols="30" rows="10" placeholder="Ingrese una descripcion" <?php if($intMarcaId == 0) echo "disabled"; ?>><?php if($intExito) echo set_value("strDescripcion") ?><?php if(isset($registro)) echo $registro->descripcion ?></textarea>
                        </div>
                        <?php echo form_error('dblPrecio'); ?>
                        <div class="form-group">
                            <label for="dblPrecio">Precio</label>
                            <input name="dblPrecio" type="text" class="form-control" id="dblPrecioMdl" placeholder="Ingrese el precio" value="<?php if($intExito) echo set_value('dblPrecio'); ?><?php if(isset($registro)) echo $registro->precio ?>">
                        </div>
                        <?php echo form_error('intStatus'); ?>
                        <div class="form-group">
                            <label for="cmbEstatus">Estatus</label>
                            <select name="intStatus" id="cmbEstatusMdl" class="form-control" 
                            <?php if($intMarcaId == 0) echo "disabled"; ?>>
                                <option value="0" id="optDefaultMdl" <?php if(($intExito && set_value("intStatus")=="0") or (isset($registro) and $registro->status=="0")) echo "selected" ?>>[ Seleccione ]</option>
                                <option value="1" id="optActivoMdl" <?php if(($intExito && set_value("intStatus")=="1") or (isset($registro) and $registro->status=="1")) echo "selected" ?> >ACTIVO</option>
                                <option value="2" id="optCanceladoMdl" <?php if(($intExito && set_value("intStatus")=="2") or (isset($registro) and $registro->status=="2")) echo "selected" ?>>CANCELADO</option>
                            </select>
                        </div>
                        <button type="button" class="btn btn-primary float-right"
                        <?php if($intMarcaId == 0) echo "disabled"; ?> id="btnAgregarModelo">Guardar</button>
                        <button type="button" class="btn btn-primary float-right"
                        <?php if($intMarcaId == 0) echo "disabled"; ?> id="btnEditarModelo">Editar</button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-7">
            <table class="table" >
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Precio</th>
                    <th scope="col" width="120px">Status</th>
                    <th scope="col" width="200px">Opciones</th>
                    </tr>
                </thead>
                <tbody id="dgModelos">
                <?php /*
                $arrMarcas=[];
                foreach($arrModelos as $key => $value){?>
                    <tr>
                    <th scope="row"><?=$value->id?></th>
                    <td><?=$value->nombre?></td>
                    <td><?=$value->status?></td>
                    <td style="display:inline-block;">
                    <form style="display:inline-block;" onsubmit="return false;">
                    <input type="hidden" value="<?=$intMarcaId?>" name="intMarcaId">
                    <input type="hidden" value="<?=$value->strId?>" name="strId">
                    <button class="btn btn-secondary" onclick="editarModelo(<?= $value->id ?>)" >Editar</button>
                    </form>
                    <form style="display:inline-block;" onsubmit="return false;">
                    <input type="hidden" value="<?=$intMarcaId?>" name="intMarcaId">
                    <input type="hidden" value="<?=$value->strId?>" name="strId">
                    <button class="btn btn-danger" onclick="borrarModelo(<?= $value->id ?>)">Eliminar</button>
                    </form>
                    </td>
                    </tr>
                <?php }*/
                ?>
                    
                
                    
                    
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-12">
                    <p class="float-right"><b id="numRegistros"><?php echo count($arrModelos); ?></b> Registros</p>
                </div>
            </div>
        </div>
    </div>
   
    
    
    
  </div>
</div>

<script type="text/javascript">

var URLactual = window.location;

if(URLactual=="http://localhost/codeigniter/modelos/"){
    $(".liMarcas").removeClass("activo");
    $(".liPedidos").removeClass("activo");
    $(".liModelos").addClass("activo");
    
}


    $("#txtNombreMdl").attr("disabled", "");
    $("#txtDescripcionMdl").attr("disabled", "");
    $("#cmbEstatusMdl").attr("disabled", "");
    $("#dblPrecioMdl").attr("disabled", "");
    $("#btnEditarModelo").hide();
    $("#btnAgregarModelo").on("click", function(e){
        $("#btnGuardarModelo").show();
        $("#btnEditarModelo").hide();
        

        
        
        
        
        
        
    });
    $(".btnEditar").click(function(e){
        
        
    });

    function ajaxPost(url, data, callback){
        $.ajax({
            url:url,
            method:"POST",
            data:data,
            dataType:"json"
        }).done(function(dataSrv){ 
            callback(dataSrv);
        }).fail(function(jqXHR, textStatus){
            alert("Error: " + textStatus);
        });
    }
    
    function actualizarLista() {
        
        ajaxPost('http://localhost/codeigniter/modelos/listar',
        $objData={
            intMarcaId:$(".cmbMarca").val()
        },
        function(data){ // data: respuesta del servidor
        
            $("#tituloAgregarEditar").text("Agregar modelo");
            $("#intMarcaId").val($(".cmbMarca").val());
            $("#btnAgregarModelo").show();
            $("#btnEditarModelo").hide();
            $("#txtIdMdl").val("");
            $("#txtNombreMdl").val("");
            $("#txtDescripcionMdl").val("");
            $("#dblPrecioMdl").val("");
            //$("#optCanceladoMdl").removeAttr("selected");
            //$("#optActivoMdl").removeAttr("selected");
            //$("#optDefaultMdl").attr("selected", "");
            $("#cmbEstatusMdl").val("0");
            $("#dgModelos").html('');
            if($(".cmbMarca").val()==0){
                $("#txtNombreMdl").attr("disabled", "");
                $("#txtDescripcionMdl").attr("disabled", "");
                $("#cmbEstatusMdl").attr("disabled", "");
                $("#dblPrecioMdl").attr("disabled", "");
                $("#btnAgregarModelo").attr("disabled", "");
                $("#btnEditarModelo").attr("disabled", "");
            }else{
                $("#txtNombreMdl").removeAttr("disabled");
                $("#txtDescripcionMdl").removeAttr("disabled");
                $("#cmbEstatusMdl").removeAttr("disabled");
                $("#dblPrecioMdl").removeAttr("disabled");
                $("#btnAgregarModelo").removeAttr("disabled");
                $("#btnEditarModelo").removeAttr("disabled");
                
            }
            $("#numRegistros").text(Object.keys(data.arrModelos).length);
            let contador = 0;
            data.arrModelos.forEach(function(modelo){
                
                ++contador;
                strRenglon = '<tr>';
                strRenglon += '<th scope="row">'+contador+'</th>';
                strRenglon += '<td>'+modelo.nombre+'</td>';
                strRenglon += '<td>'+Intl.NumberFormat('es-MX', {style:'currency',currency:'MXN'}).format(modelo.precio)+'</td>';
                strRenglon += '<td>'+modelo.status+'</td>';
                strRenglon += '<td style="display:inline-block;">';
                strRenglon += '<form style="display:inline-block;" onsubmit="return false;">';
                strRenglon += '<input type="hidden" value="'+modelo.marca_id+'" name="intMarcaId">';
                strRenglon += '<input type="hidden" value="'+modelo.strId+'" name="strId">';
                strRenglon += '<button class="btn btn-secondary" onclick="editarModelo('+modelo.id+')">Editar</button>';
                strRenglon += '</form>';
                strRenglon += '<form style="display:inline-block; margin-left:5px" onsubmit="return false;">';
                strRenglon += '<input type="hidden" value="'+modelo.marca_id+'" name="intMarcaId">';
                strRenglon += '<input type="hidden" value="'+modelo.strId+'" name="strId">';
                strRenglon += '<button class="btn btn-danger" onclick="borrarModelo('+modelo.id+')">Eliminar</button>';
                strRenglon += '</form>';
                strRenglon += '</td>';
                strRenglon += '</tr>';
                $("#dgModelos").append(strRenglon);
            });
        });
    }

    function editarModelo(id){
        
        $("#btnAgregarModelo").hide();
        $("#btnEditarModelo").show();
        $.get("http://localhost/codeigniter/modelos/obtenerModelo/"+id, function( data ) {
            
            $("#tituloAgregarEditar").text("Editar modelo");
            $("#txtIdMdl").val(data.id);
            $("#txtNombreMdl").val(data.nombre);
            $("#txtDescripcionMdl").val(data.descripcion);
            $("#dblPrecioMdl").val(data.precio);
            // if(data.status=="1"){
            //     $("#optDefaultMdl").removeAttr("selected");
            //     $("#optCanceladoMdl").removeAttr("selected");
            //     $("#optActivoMdl").attr("selected", "");

            // }else{
            //     $("#optDefaultMdl").removeAttr("selected");
            //     $("#optActivoMdl").removeAttr("selected");
            //     $("#optCanceladoMdl").attr("selected", "");
            // }

            $("#cmbEstatusMdl").val(data.status);


            
});
    }

    
    function borrarModelo(id){
        
        $.ajax({
            url: "http://localhost/codeigniter/modelos/eliminarModelo/"+id,
            type: 'DELETE',
            success: function(result) {
                actualizarLista();
                console.log(result.arrMensaje);
                strHtml='<div class="alert alert-dismissible fade show alert-success role="alert"><strong>'+(result.arrMensaje[0].intTipo==1 ? "Exito" : "Error")+'</strong>'+result.arrMensaje[0].strMensaje+'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                strHtml+= '<span aria-hidden="true">&times;</span>';
                strHtml+= '</button></div>';
                //$("#mensaje").html(strHtml);
                if(result.arrMensaje[0].intTipo==1){
                    alertify.success('<strong>¡Excelente! </strong>' + result.arrMensaje[0].strMensaje);
                }else{
                    alertify.error('<strong>¡Error! </strong>' + result.arrMensaje[0].strMensaje);
                }
                

            }
        });
    }

    $("#btnAgregarModelo").on("click", function(e){
        
        $objData={
            intId:$("#txtIdMdl").val(),
            intMarcaId:$("#intMarcaId").val(),
            strNombre:$("#txtNombreMdl").val(),
            strDescripcion:$("#txtDescripcionMdl").val(),
            dblPrecio:$("#dblPrecioMdl").val(),
            intStatus:$("#cmbEstatusMdl").val()
        };
        
        ajaxPost('http://localhost/codeigniter/modelos/guardar',$objData,
        
            function(data){ // data: respuesta del servidor
                
            if(data.intErrorValidacion==1){
                //$("#divMensajes").html(data.strMensaje);

                alertify.error('No se pudo agregar el modelo');
                alertify.error(data.strMensaje);
                
            }else{
                $("#txtIdMdl").val("");
                $("#txtNombreMdl").val("");
                $("#dblPrecioMdl").val("");
                $("#txtDescripcionMdl").val("");
                $("#optActivoMdl").removeAttr("selected");
                $("#optCanceladoMdl").removeAttr("selected");
                $("#optDefaultMdl").attr("selected", "");
                
                strHtml='<div class="alert alert-dismissible fade show alert-'+(data.arrMensaje[0].intTipo==1 ? 'success" role="alert">' : 'danger" role="alert">')+'<strong>'+(data.arrMensaje[0].intTipo==1 ? 'Excelente' : 'Error')+'</strong> '+data.arrMensaje[0].strMensaje+' <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                strHtml+= '<span aria-hidden="true">&times;</span>';
                strHtml+= '</button></div>';
                alertify.success('Modelo agregado correctamente!');
                //$("#divMensajes").html(strHtml);
                if(data.arrMensaje[0].intTipo==1){
                    actualizarLista();
                    //$("#btnAtras").click();
                }
            }
            
        });
    });

    $("#btnEditarModelo").on("click", function(e){
        
        $objData={
            intId:$("#txtIdMdl").val(),
            intMarcaId:$("#intMarcaId").val(),
            strNombre:$("#txtNombreMdl").val(),
            dblPrecio:$("#dblPrecioMdl").val(),
            strDescripcion:$("#txtDescripcionMdl").val(),
            intStatus:$("#cmbEstatusMdl").val()
        };
        
        
        ajaxPost('http://localhost/codeigniter/modelos/guardar',$objData,
            function(data){ // data: respuesta del servidor

            
            if(data.intErrorValidacion==1){
                //$("#divMensajes").html(data.strMensaje);

                alertify.error('No se pudo editar el modelo');
                alertify.error(data.strMensaje);
                
            }else{
                
                strHtml='<div class="alert alert-dismissible fade show alert-'+(data.arrMensaje[0].intTipo==1 ? 'success" role="alert">' : 'danger" role="alert">')+'<strong>'+(data.arrMensaje[0].intTipo==1 ? 'Excelente' : 'Error')+'</strong> '+data.arrMensaje[0].strMensaje+' <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                strHtml+= '<span aria-hidden="true">&times;</span>';
                strHtml+= '</button></div>';
                alertify.success('Modelo editado correctamente!');
                
                //$("#divMensajes").html(strHtml);
                if(data.arrMensaje[0].intTipo==1){
                    actualizarLista();
                    
                }
            }
            
        });
    });
    


</script>