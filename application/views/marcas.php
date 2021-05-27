<div id="mensaje"></div>
<div class="card">
  <h5 class="card-header">Marcas 
  <button id="btnAgregar" class="btn btn-primary float-right">Agregar nueva marca</button>
  <button id="btnAtras" style="display:none;" class="btn btn-secondary float-right">Atras</button></h5>
  <div class="card-body">
  
  <h5 class="card-title">Listado de Marcas</h5>
    <div id="divListar">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col" width="120px">Status</th>
                <th scope="col" width="200px">Opciones</th>
                </tr>
            </thead>
            
            <tbody id="dgMarcas">
            <?php 
            $contador=0;
            foreach($arrMarcas as $key => $value){
            ++$contador;
                ?>
                <tr>
                    <th scope="row"><?=$contador?></th>
                    <td id="marca<?= $value->id ?>" class="idMarca d-none"><?= $value->id ?></td>
                    <td id="tdNombre"><?=$value->nombre?></td>
                    <script>
                        var marcaId=$("#marca<?= $value->id ?>").text();
                        
                    </script>
                    <!--<td id="tdDescripcion" class="d-none"></td>-->
                    <td id="tdStatus"><?=$value->status?></td>
                    <td style="display:inline-block;">
                    <form onsubmit="return false;" style="display:inline-block;">
                    <input type="hidden" value="<?=$value->strId?>" name="strId">
                    <button class="btn btn-secondary btnEditar" onclick="editarMarca(<?= $value->id ?>)">Editar</button>
                    </form>
                    <form onsubmit="return false;" onsubmit="if(confirm('Eliminar?')) ? editarMarca(<?= $value->id ?>) : return false;" style="display:inline-block;">
                    <input type="hidden" value="<?=$value->strId?>" name="strId">
                    <button class="btn btn-danger btnBorrar" onclick="borrarMarca(<?= $value->id ?>);" id="btnEliminar">Eliminar</button>
                    </form>
                    </td>
                </tr>
            <?php  }
            ?>
                
            
                
                
            </tbody>
            
        </table>

        <div class="row">
                    <div class="col-12">
                        <p class="float-right"><b id="numRegistros"><?php echo count($arrMarcas); ?></b> Registros</p>
                    </div>
                </div>
        
    
    </div>

    <div id="divFormulario" style="display:none;">
        <form>
            <div class="form-group">
                <label for="txtId">ID</label>
                <input name="intId" type="text" class="form-control" id="txtId" placeholder="[Nuevo]" readonly="" value="<?= set_value('intId') ?><?php if(isset($registro)) echo $registro->id; ?>">
                
            </div>
            <?php echo form_error('strNombre'); ?>
            <div class="form-group">
                <label for="txtNombre">Nombre</label>
                <input name="strNombre" type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" value="<?= set_value('strNombre') ?><?php if(isset($registro)) echo $registro->nombre ?>">
            </div>
            <?php echo form_error('strDescripcion'); ?>
            <div class="form-group">
                <label for="txtNombre">Descripcion</label>
                <textarea name="strDescripcion" class="form-control" id="txtDescripcion" cols="30" rows="10" placeholder="Ingrese una descripcion"><?= set_value("strDescripcion") ?><?php if(isset($registro)) echo $registro->descripcion ?></textarea>
            </div>
            <?php echo form_error('intStatus'); ?>
            <div class="form-group">
                <label for="cmbEstatus">Estatus</label>
                <select name="intStatus" id="cmbEstatus" class="form-control">
                    <option value="0" id="optDefault" <?php if(set_value("intStatus")=="0" or (isset($registro) and $registro->status=="0")) echo "selected" ?>>[ Seleccione ]</option>
                    <option value="1" id="optActivo" <?php if(set_value("intStatus")=="1" or (isset($registro) and $registro->status=="1")) echo "selected" ?> >ACTIVO</option>
                    <option value="2" id="optCancelado" <?php if(set_value("intStatus")=="2" or (isset($registro) and $registro->status=="2")) echo "selected" ?>>CANCELADO</option>
                </select>
            </div>
            <button id="btnGuardar" type="button" class="btn btn-primary float-right">Guardar</button>
            <button id="btnEditarMarca" type="button" class="btn btn-primary float-right">Editar</button>
            
            
            
        </form>
    </div>
    
    
    <hr>
    
  </div>
</div>
<script type="text/javascript">
var URLactual = window.location;
if(URLactual=="http://localhost/codeigniter/marcas/"){
    $(".liModelos").removeClass("activo");
    $(".liPedidos").removeClass("activo");
    $(".liMarcas").addClass("activo");
    
}

    $("#btnAgregar").on("click", function(e){
        $("#btnGuardar").show();
        $("#btnEditarMarca").hide();
        
        $("#txtId").val("");
        $("#txtNombre").val("");
        $("#txtDescripcion").val("");
        $("#optActivo").removeAttr("selected");
        $("#optCancelado").removeAttr("selected");
        $("#optDefault").attr("selected", "");
        $("#cmbEstatus").val("0");
        
        $("#divListar").toggle("fast");
        $("#divFormulario").toggle("fast");
        $("#btnAtras").toggle("fast");
        $("#btnAgregar").toggle("fast");
        
        
        
    });
    $(".btnEditar").click(function(e){
        
        
    });
    

    $("#btnAtras").on("click", function(e){
        $("#divListar").toggle("fast");
        $("#divFormulario").toggle("fast");
        $("#btnAtras").toggle("fast");
        $("#btnAgregar").toggle("fast");
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
        ajaxPost('http://localhost/codeigniter/marcas/listar',{},
        function(data){ // data: respuesta del servidor
       
            $("#dgMarcas").html('');
            let contador = 0;
            $("#numRegistros").text(Object.keys(data.arrMarcas).length);
            data.arrMarcas.forEach(function(marca){
                ++contador;
                strRenglon = '<tr>';
                strRenglon += '<th scope="row">'+contador+'</th>';
                strRenglon += '<td>'+marca.nombre+'</td>';
                strRenglon += '<td>'+marca.status+'</td>';
                strRenglon += '<td style="display:inline-block;">';
                strRenglon += '<form onsubmit="return false;" style="display:inline-block;">';
                strRenglon += '<input type="hidden" value="'+marca.id+'" name="strId">';
                strRenglon += '<button class="btn btn-secondary btnEditar" onclick="editarMarca(' + marca.id + ')">Editar</button>';
                strRenglon += '</form>';
                strRenglon += '<form onsubmit="return false;" style="display:inline-block; margin-left:5px">';
                strRenglon += '<input type="hidden" value="'+marca.id+'" name="strId">';
                strRenglon += '<button class="btn btn-danger" onclick="borrarMarca(' + marca.id + ')" id="btnEliminar">Eliminar</button>';
                strRenglon += '</form>';
                strRenglon += '</td>';
                strRenglon += '</tr>';
                $("#dgMarcas").append(strRenglon);
            });
        });
    }

    function editarMarca(id){
        $("#divListar").toggle("fast");
        $("#divFormulario").toggle("fast");
        $("#btnAtras").toggle("fast");
        $("#btnAgregar").toggle("fast");
        $("#btnGuardar").hide();
        $("#btnEditarMarca").show();
        $.get("http://localhost/codeigniter/marcas/obtenerMarca/"+id, function( data ) {
            
            $("#txtId").val(data.id);
            $("#txtNombre").val(data.nombre);
            $("#txtDescripcion").val(data.descripcion);
            $("#cmbEstatus").val(data.status);
            if(data.status=="1"){
                $("#optDefault").removeAttr("selected");
                $("#optCancelado").removeAttr("selected");
                $("#optActivo").attr("selected", "");
            }else{
                $("#optDefault").removeAttr("selected");
                $("#optActivo").removeAttr("selected");
                $("#optCancelado").attr("selected", "");
            }
            
});
    }

    
    function borrarMarca(id){
        
        $.ajax({
            url: "http://localhost/codeigniter/marcas/eliminarMarca/"+id,
            type: 'DELETE',
            success: function(result) {
                
                actualizarLista();
                if(result.arrMensaje[0].intTipo==1){
                    alertify.success('Marca eliminada correctamente!');
                }else{
                    alertify.error(result.arrMensaje[0].strMensaje);
                }
                
                
            }
        });
    }

    $("#btnGuardar").on("click", function(e){
        $objData={
            intId: $("#txtId").val(),
            strNombre:$("#txtNombre").val(),
            strDescripcion:$("#txtDescripcion").val(),
            intStatus:$("#cmbEstatus").val()
        };
        
        ajaxPost('http://localhost/codeigniter/marcas/guardar',$objData,
            function(data){ // data: respuesta del servidor
            if(data.intErrorValidacion==1){
                //$("#divMensajes").html(data.strMensaje);
                
                
                alertify.error(data.strMensaje);
                
            }else{
                
                strHtml='<div class="alert alert-dismissible fade show alert-'+(data.intExito==1 ? 'success" role="alert">' : 'danger" role="alert">')+'<strong>'+(data.intExito==1 ? 'Excelente' : 'Error')+'</strong> '+data.strMensaje+' <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                strHtml+= '<span aria-hidden="true">&times;</span>';
                strHtml+= '</button></div>';
                
                //$("#divMensajes").html(strHtml);
                if(data.intExito==1){
                    actualizarLista();
                    $("#btnAtras").click();
                    alertify.success('Registro agregado correctamente!');
                }
            }
            
        });
    });

    $("#btnEditarMarca").on("click", function(e){
        
        $objData={
            intId: $("#txtId").val(),
            strNombre:$("#txtNombre").val(),
            strDescripcion:$("#txtDescripcion").val(),
            intStatus:$("#cmbEstatus").val()
        };
        
        ajaxPost('http://localhost/codeigniter/marcas/guardar',$objData,
            function(data){ // data: respuesta del servidor
            if(data.intErrorValidacion==1){
                //$("#divMensajes").html(data.strMensaje);

                alertify.error('No se pudo editar el registro');
                alertify.error(data.strMensaje);
            }else{
                
                strHtml='<div class="alert alert-dismissible fade show alert-'+(data.intExito==1 ? 'success" role="alert">' : 'danger" role="alert">')+'<strong>'+(data.intExito==1 ? 'Excelente' : 'Error')+'</strong> '+data.strMensaje+' <button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                strHtml+= '<span aria-hidden="true">&times;</span>';
                strHtml+= '</button></div>';
                alertify.success('Registro editado correctamente!');
                //$("#divMensajes").html(strHtml);
                if(data.intExito==1){
                    actualizarLista();
                    $("#btnAtras").click();
                    
                }
            }
            
        });
    });
    


</script>
<div id="contenidoDinamico">
    
</div>