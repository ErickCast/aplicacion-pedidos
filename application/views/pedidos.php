<!--<link rel="stylesheet" href="css/datepicker.css">-->
    
    <!-- JavaScript -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!--<script src="js/bootstrap-datepicker.js"></script>-->
    <!--<script src="js/bootstrap-datepicker.es.js"></script>-->
    <script src="js/moment.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js"></script>

<div class="card">
Filtrar por fecha:
    <div class="filtro input-append date form-inline" id="filtro">
        
        Del <input type="text" id="fechaInicial" placeholder="Fecha inicial..." class="form-control w-25"> al <input type="text" id="fechaFinal" placeholder="Fecha final..." class="form-control w-25"> 
        <button class="btn btn-primary ml-3" id="filtrarPorFecha">Filtrar</button>
        
    </div>

    
  <h5 class="card-header">Pedidos
  <span class="carrito float-right ml-5 d-none" style="font-size:35px"><i class="fas fa-shopping-cart"></i>
        <div id="carrito" style="position:absolute; right:30px">
                                        
                                <table id="lista-carrito" class="table table-bordered bg-white">
                                            <thead>
                                                <tr>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Precio</th>
                                                    <th>Cantidad</th>
                                                    <th>SubTotal</th>
                                                    <th>Total</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                        <div class="d-flex">
                                        <a href="#" id="vaciar-carrito" class="btn btn-danger w-50">Vaciar Carrito</a>
                                        <a href="#" id="finalizar-pedido" class="btn btn-success w-50">Finalizar pedido</a>
                                        </div>
        </div>
    </span>
  
  <button id="btnAgregarPedido" class="btn btn-primary float-right">Agregar nuevo pedido</button>
  <button id="btnAtrasPedido" style="display:none;" class="btn btn-secondary float-right">Atras</button></h5>
  <div class="card-body">
  
  <h5 class="card-title tituloPedidos">Listado de Pedidos</h5>
    <div id="divListar">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th>FECHA</th>
                <th>NOMBRE DEL CLIENTE</th>
                <!--<th>PRODUCTOS</th>-->
                <th>MONTO</th>
                <th>ESTADO</th>
                <th>OPCIONES</th>
                </tr>
            </thead>
            
            <tbody id="dgPedidos">
            
            </tbody>
            
        </table>

        <div class="row">
                    <div class="col-12">
                        <p class="float-right"><b id="numRegistros"><?php echo count($arrPedidos); ?></b> Registros</p>
                        
                    </div>
                </div>
        
    
    </div>
    <div class="row">
    <div id="divFormulario" class="col-12 col-lg-5" style="display:none;">
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
            <div class="form-group">
                <label for="txtApellido">Apellido</label>
                <input name="strApellido" type="text" class="form-control" id="txtApellido" placeholder="Ingrese el apellido" value="<?= set_value('strApellido') ?><?php if(isset($registro)) echo $registro->apellido ?>">
            </div>
            <div class="form-group">
                <label for="txtDomicilio">Domicilio</label>
                <input name="strDomicilio" type="text" class="form-control" id="txtDomicilio" placeholder="Ingrese el domicilio" value="<?= set_value('strDomicilio') ?><?php if(isset($registro)) echo $registro->domicilio ?>">
            </div>
            <div class="form-group">
                <label for="txtTelefono">Telefono</label>
                <input name="strTelefono" type="text" class="form-control" id="txtTelefono" placeholder="Ingrese el telefono" value="<?= set_value('strTelefono') ?><?php if(isset($registro)) echo $registro->telefono ?>">
            </div>
            <?php echo form_error('intEstado'); ?>
            <div class="form-group">
                <label for="cmbEstado">Estado</label>
                <select name="intEstatus" id="cmbEstatus" class="form-control">
                    <option value="0" id="optDefault" <?php if(set_value("intStatus")=="0" or (isset($registro) and $registro->status=="0")) echo "selected" ?>>[ Seleccione ]</option>
                    <option value="1" id="optActivo" <?php if(set_value("intStatus")=="1" or (isset($registro) and $registro->status=="1")) echo "selected" ?> >ACTIVO</option>
                    <option value="2" id="optPendiente" <?php if(set_value("intStatus")=="2" or (isset($registro) and $registro->status=="2")) echo "selected" ?>>PENDIENTE</option>
                    <option value="3" id="optSurtido" <?php if(set_value("intStatus")=="3" or (isset($registro) and $registro->status=="3")) echo "selected" ?>>SURTIDO</option>
                    <option value="4" id="optFinalizado" <?php if(set_value("intStatus")=="4" or (isset($registro) and $registro->status=="4")) echo "selected" ?>>FINALIZADO</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cmbMarca">Marca</label>
                <select name="intMarca" id="cmbMarca" class="form-control">
                    <option value="0" id="optDefault" <?php if(set_value("intStatus")=="0" or (isset($registro) and $registro->status=="0")) echo "selected" ?>>[ Seleccione ]</option>
                    <?php 
            
                    foreach($arrMarcas as $key => $value){?>
                        
                        <option class="optMarca" value="<?=$value->id?>"><?=$value->nombre?> </option>
                <?php   }
            ?>
                </select>
            </div>
            <div class="form-group mb-5">
                <label for="cmbModelo">Modelo</label>
                <select name="intModelo" id="cmbModelo" class="form-control">
                    <option value="0">[ Seleccione primero una marca ]</option>
                </select>
            </div>
            <input type="hidden" name="" id="txtModelo">
            <input type="hidden" name="" id="txtPrecioModelo">
            <button id="btnAgregarCarrito" type="button" class="btn btn-primary float-right">Agregar al carrito</button>
            
            
            
            
        </form>
    </div>

    <div class="lista col-12 col-lg-7" style="display:none;">
        <table class="table table-bordered table-responsive">
        <tr>
            <th>MARCA</th>
            <th>MODELO</th>
            <th>PRECIO</th>
            <th>CANTIDAD</th>
            <th>SUBTOTAL</th>
            
            <th>OPCIONES</th>
        </tr>
        <tbody id="carritoPedido">
                        
        </body>
        
        </table>
        
        <div class="d-flex">
            <button class="btn btn-danger vaciar-carrito w-50">Limpiar lista</button>
            <button class="btn btn-success finalizar-pedido w-50">Finalizar pedido</button>
            <button id="btnEditarPedido" type="button" class="btn btn-success w-50">Editar Pedido</button>
        </div>
    </div>
    </div>
    
    
    <hr>
    
  </div>
</div>

<script>
var URLactual = window.location;
if(URLactual=="http://localhost/codeigniter/pedidos/"){
    $(".liModelos").removeClass("activo");
    $(".liMarcas").removeClass("activo");
    $(".liPedidos").addClass("activo");
}

$( "#fechaInicial" ).datepicker({
    format: "dd-mm-yy",    
    language: 'es'
});
$( "#fechaFinal" ).datepicker({
    format: "dd-mm-yy",
    language: 'es'
    
});

if($("#cmbMarca").val==0){
    $("#cmbModelo").html("<option value='0'>[ Seleccione primero una marca ]</option>");
}

moment.lang('es', {
  months: 'Enero_Febrero_Marzo_Abril_Mayo_Junio_Julio_Agosto_Septiembre_Octubre_Noviembre_Diciembre'.split('_'),
  monthsShort: 'Enero._Feb._Mar_Abr._May_Jun_Jul._Ago_Sept._Oct._Nov._Dec.'.split('_'),
  weekdays: 'Domingo_Lunes_Martes_Miercoles_Jueves_Viernes_Sabado'.split('_'),
  weekdaysShort: 'Dom._Lun._Mar._Mier._Jue._Vier._Sab.'.split('_'),
  weekdaysMin: 'Do_Lu_Ma_Mi_Ju_Vi_Sa'.split('_')
}
);
actualizarLista();


    $("#carrito").hide();
    $(".carrito").mouseover(function(){
        $("#carrito").show();
  	});
 
	$(".carrito").mouseout(function(){
        $("#carrito").hide();
 	}); 

    
    
     

    $("#btnAgregarPedido").on("click", function(e){
        limpiarFormulario();
        $("#btnAgregarCarrito").show();
        $(".finalizar-pedido").show();
        $("#btnEditarPedido").hide();
        $(".tituloPedidos").html("Agregar pedido");
        $(".precioTotal").html("");
        $("#filtro").hide();
        
        $("#divListar").toggle("fast");
        $("#divFormulario").toggle("fast");
        $(".lista").toggle("fast");
        $("#btnAtrasPedido").toggle("fast");
        $("#btnAgregarPedido").toggle("fast");
        $(".carrito").toggle("fast");
        $("#carritoPedido").html("");
        actualizarLista();
        
        
    });
    $(".btnEditar").on("click", function(e){
        
        

        
        
        
        
    });

    function limpiarFormulario(){
        $("#divFormulario form").trigger("reset");
    }
    
    let carrito = [];
    
    

    
    function editarPedido(id){
        actualizarLista();
        $("#filtro").hide();
        $(".finalizar-pedido").hide();
        $("#btnEditarPedido").show();
        $("#btnAgregarCarrito").addClass("d-block mb-3");
        $("#btnEditarPedido").show();
        $(".tituloPedidos").html("Editar pedido");
        
        
        $("#divListar").toggle("fast");
        $("#divFormulario").toggle("fast");
        $(".lista").toggle("fast");
        $("#btnAtrasPedido").toggle("fast");
        $("#btnAgregarPedido").toggle("fast");
        $(".carrito").toggle("fast");
        
        //ajaxPost("http://localhost/codeigniter/pedidos/sacarOrdenes/"+id, {}, function(data){
        //let listaProductos=data.arrOrdenes;
        
        
        
        $.get("http://localhost/codeigniter/pedidos/obtenerPedido/"+id, function( data ) {
        
            $("#txtId").val(data.pedido[0].id);
            $("#txtNombre").val(data.pedido[0].nombre);
            $("#txtApellido").val(data.pedido[0].apellido);
            $("#txtDomicilio").val(data.pedido[0].domicilio);
            $("#txtTelefono").val(data.pedido[0].telefono);
            $("#cmbEstatus").val(data.pedido[0].estado);
            console.log(data);

        //let listaProductos=JSON.parse(data.pedido[0].productos);
        
        
        
        let listaProductos=data.arrOrdenes;
        let strHtml="";
        let strHtml2="";
        let totalMostrar=0;
        let subTotal=0;
        let total=0;
        let iva=0;
        let totalIva=0;
        let totalSubTotal=0;
        let i=0;
        
       

        listaProductos.forEach(function(producto){
            
            
            $.ajax({
            url: "http://localhost/codeigniter/pedidos/obtenerModeloYMarca/"+producto.modelo_id,
            type: 'POST',
            success: function(result) {
                console.log(result);
               subTotal=(result.modelo.precio*producto.cantidad);
               totalPrecio=(result.modelo.precio*producto.cantidad) + ((result.modelo.precio*producto.cantidad)*data.iva);
               diferenciaIva=((result.modelo.precio*producto.cantidad)*data.iva);
                const productoEditar ={
                    id:producto.modelo_id,
                    marca:result.modelo.nombre_marca,
                    modelo:result.modelo.nombre,
                    precio:result.modelo.precio,
                    cantidad:producto.cantidad,
                    subTotal:subTotal,
                    iva:data.iva,
                    total:totalPrecio
                }
                
                console.log(producto);
                carrito.push(productoEditar);
                limpiarHTML();
                
                strHtml+="<tr>";
                strHtml+="<td>"+result.modelo.nombre_marca+"</td>";
                strHtml+="<td>"+result.modelo.nombre+"</td>";
                strHtml+="<td class='text-right'>"+Intl.NumberFormat('es-MX', {style:'currency',currency:'MXN'}).format(result.modelo.precio)+"</td>";
                strHtml+="<td class='d-flex justify-content-between btnSumar'><i onclick='restarCantidad("+result.modelo.id+");' style='cursor:pointer; color:red; font-size:20px' id='"+result.id+"' class='fas fa-minus-square btnRestar'></i><input type='number' class='inputCantidad' onkeyup='asignarCantidad("+producto.id+");' onblur='asignarCantidad("+producto.id+");' id='cantidad"+producto.id+"' style='width:45px; text-align:center;' value='"+producto.cantidad+"' onkeypress='return event.charCode >= 48' min='1'><i onclick='aumentarCantidad("+result.id+");' style='cursor:pointer; color:green; font-size:20px' id='"+result.id+"' class='fas fa-plus-square btnSumar'></i></td>";
                strHtml+="<td class='text-right'>"+Intl.NumberFormat('es-MX', {style:'currency',currency:'MXN'}).format(subTotal)+"</td>";
                
                strHtml+="<td class='text-center'><button class='btn btn-danger' onclick='eliminarProducto("+producto.id+")'>X</button></td>";
                strHtml+="</tr>";
                $("#carritoPedido").append(strHtml);
                totalSubTotal+=subTotal;
                totalMostrar += parseFloat(totalPrecio);
                totalIva+=diferenciaIva;
                i++;
                
                strHtml2=`<tr>
                <td></td>
                <td></td>
                <td><b>Subtotal<b></td>
                <td class="text-right">${Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(totalSubTotal)}</td>
                
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td><b>IVA<b></td>
                <td class="text-right">${Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(totalIva)}</td>
                
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td><b>Total<b></td>
                <td class="text-right">${Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(totalMostrar)}</td>
                
                </tr>`;
                $("#carritoPedido").append(strHtml2);
                
            }
            });

            
            
            

            
        });
        
            
        });

    //});
    }

    function asignarCantidad(id){
        if($("#cantidad"+id).val()>=1){
            if(event.key === 'Enter' || event.type=="blur") {
            
            const existe = carrito.some(productoCarrito => productoCarrito.id == id);

            carrito = carrito.map(productoCarrito => {
                            if(productoCarrito.id == id){
                                productoCarrito.cantidad=$("#cantidad"+id).val();
                                productoCarrito.subTotal=productoCarrito.precio*productoCarrito.cantidad;
                                productoCarrito.total=productoCarrito.subTotal + (productoCarrito.subTotal*0.16);
                                return productoCarrito; // retorna el objeto actualizado
                            }else{
                                return productoCarrito; // retorna los objetos que no son los duplicados
                            }
                        });

            
            let totalMostrar=0;
            $("#carritoPedido").html("");
            actualizarListaCarrito();
            }
        }else{
            if(event.key==="enter" || event.type=="blur"){
                alertify.error("¡Elija una cantidad valida!");
            }
            
        }
        
        
    }

    

    function restarCantidad(id){
        const existe = carrito.some(productoCarrito => productoCarrito.id == id);
        
        carrito = carrito.map(productoCarrito => {
            if(productoCarrito.cantidad==1){
                alertify.error("No se puede restar mas la cantidad");
                return productoCarrito;
            }else{
                if(productoCarrito.id == id){
                    productoCarrito.cantidad--;
                    productoCarrito.subTotal=productoCarrito.precio*productoCarrito.cantidad;
                    productoCarrito.total=productoCarrito.subTotal + (productoCarrito.subTotal*0.16);
                    return productoCarrito; // retorna el objeto actualizado
                }else{
                    return productoCarrito; // retorna los objetos que no son los duplicados
                }
            }
                        
                    });

        
        
        let totalMostrar=0;
        $("#carritoPedido").html("");
        actualizarListaCarrito();
        
    }

    function aumentarCantidad(id){
        const existe = carrito.some(productoCarrito => productoCarrito.id == id);
        
        carrito = carrito.map(productoCarrito => {
                        if(productoCarrito.id == id){
                            productoCarrito.cantidad++;
                            productoCarrito.subTotal=productoCarrito.precio*productoCarrito.cantidad;
                            productoCarrito.total=productoCarrito.subTotal + (productoCarrito.subTotal*0.16);
                            return productoCarrito; // retorna el objeto actualizado
                        }else{
                            return productoCarrito; // retorna los objetos que no son los duplicados
                        }
                    });

        

        let totalMostrar=0;
        $("#carritoPedido").html("");
        actualizarListaCarrito();
    }

    function eliminarProducto(id){
    
        

        //Elimina del arreglo de articulosCarrito por el data-id
        carrito = carrito.filter(productoCarrito => productoCarrito.id != id );

        let totalMostrar=0;
        $("#carritoPedido").html("");
        actualizarListaCarrito();
        
    
        

    
    }    

    function borrarPedido(id){
        
        $.ajax({
            url: "http://localhost/codeigniter/pedidos/eliminarPedido/"+id,
            type: 'DELETE',
            success: function(result) {
                actualizarLista();
                
                strHtml='<div class="alert alert-dismissible fade show alert-success role="alert"><strong>Exito</strong> Pedido eliminado correctamente<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                strHtml+= '<span aria-hidden="true">&times;</span>';
                strHtml+= '</button></div>';
                //$("#mensaje").html(strHtml);
                alertify.success('Pedido eliminado correctamente!');
            }
        });
    }

    //Filtrando los datos por fecha
    $("#filtrarPorFecha").on("click", function(){
        let fechaInicial=moment($("#fechaInicial").val(), "DD-mm-YY").format("yy-mm-DD");
        let fechaFinal=moment($("#fechaFinal").val(), "DD-mm-YY").format("yy-mm-DD");
        console.log(fechaInicial);
        console.log(fechaFinal);
        
        if($("#fechaInicial").val()=="" && $("#fechaFinal").val()==""){
            actualizarLista();
        }else if($("#fechaInicial").val()=="" || $("#fechaFinal").val()==""){
            alertify.error("¡Se deben llenar ambos campos para filtrar los pedidos!");
        }else{
            let objData={};
            objData={
                fechaInicial:fechaInicial,
                fechaFinal:fechaFinal
            };
            
            ajaxPost("http://localhost/codeigniter/pedidos/obtenerPorFecha/", objData, function(data){
                nuevaListaPedidos(data, "Sin resultados para la busqueda");
            });
        }
        
    });
    
    $("#btnEditarPedido").on("click", function(){
        if(carrito.length>=1){
            $("#btnEditarPedido").attr("disabled", "");
            $("#cmbModelo").html("<option value='0'>[ Seleccione primero una marca ]</option>");
        }
        
        if(carrito.length==0){
            alertify.error("¡Para editar, la lista no debe quedar vacia!");
            $("#btnEditarPedido").removeAttr("disabled");
        }else{
            let productosJson="";
            i=1;
        productosJson+="{\"productos\": [";
        
        carrito.forEach(function(producto){
            if(i===carrito.length){
                productosJson+="{ \"id\": \""+producto.id+"\", \"cantidad\":\""+producto.cantidad+"\" }";
            }else{
                //productosJson+="\""+producto.id+" x"+producto.cantidad+"\", ";
                productosJson+="{ \"id\": \""+producto.id+"\", \"cantidad\":\""+producto.cantidad+"\" },";
                i++;
            }
            
            
        });

        productosJson+="]}";
        
        
        let totalMonto=0;
        carrito.forEach(producto=>{
                totalMonto+=producto.total;
        });
        $objData={
            intId:$("#txtId").val(),
            nombre:$("#txtNombre").val(),
            apellido:$("#txtApellido").val(),
            domicilio:$("#txtDomicilio").val(),
            telefono:$("#txtTelefono").val(),
            ordenes:productosJson,
            estado:$("#cmbEstatus").val(),
            monto:totalMonto
        }
        console.log(productosJson);

        
        
                ajaxPost("http://localhost/codeigniter/pedidos/guardar", $objData,
                function(data){
                    $("#btnEditarPedido").removeAttr("disabled");
                    alertify.success('Pedido Editado');
                    actualizarLista();
                    limpiarFormulario();
                    $("#cmbModelo").val("0");
                    $("#btnAtrasPedido").click();
                    carrito=[];
                });

                

            
            

            

        
        }
        
    });

    $(".vaciar-carrito").on("click", function(){
        carrito=[];
        $("#lista-carrito tbody").html("");
        $("#carritoPedido").html("");
        $(".precioTotal").html("");

    });
    
    $("#vaciar-carrito").on("click", function(){
        carrito=[];
        $("#lista-carrito tbody").html("");
        $("#carritoPedido").html("");
        $(".precioTotal").html("");
        

    });

    function actualizarListaCarrito(){
        let totalSubTotal=0;
        let totalMostrar=0;
        let totalIva=0;
        let strHtml="";
        
        carrito.forEach(function(producto){
            
                limpiarHTML();
                
                strHtml+="<tr>";
                strHtml+="<td>"+producto.marca+"</td>";
                strHtml+="<td>"+producto.modelo+"</td>";
                strHtml+="<td class='text-right'>"+Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(producto.precio)+"</td>";
                strHtml+="<td class='d-flex justify-content-between btnSumar'><i onclick='restarCantidad("+producto.id+");' style='cursor:pointer; color:red; font-size:20px' id='"+producto.id+"' class='fas fa-minus-square btnRestar'></i><input type='number' class='inputCantidad' onkeyup='asignarCantidad("+producto.id+");' onblur='asignarCantidad("+producto.id+");' id='cantidad"+producto.id+"' style='width:45px; text-align:center;' value='"+producto.cantidad+"' onkeypress='return event.charCode >= 48' min='1'><i onclick='aumentarCantidad("+producto.id+");' style='cursor:pointer; color:green; font-size:20px' id='"+producto.id+"' class='fas fa-plus-square btnSumar'></i></td>";
                strHtml+="<td class='text-right'>"+Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(producto.subTotal)+"</td>";
                
                strHtml+="<td class='text-center'><button class='btn btn-danger' onclick='eliminarProducto("+producto.id+")'>X</button></td>";
                strHtml+="</tr>";
                
                $("#carritoPedido").append(strHtml);
                totalSubTotal+=parseFloat(producto.subTotal);
                totalMostrar += parseFloat(producto.total);
                totalIva+=producto.subTotal*0.16;
                

                strHtml2=`<tr>
                <td></td>
                <td></td>
                <td><b>Subtotal<b></td>
                <td class="text-right">${Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(totalSubTotal)}</td>
                
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td><b>IVA<b></td>
                <td class="text-right">${Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(totalIva)}</td>
                
                </tr>
                <tr>
                <td></td>
                <td></td>
                <td><b>Total<b></td>
                <td class="text-right">${Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(totalMostrar)}</td>
                
                </tr>`;
                $("#carritoPedido").append(strHtml2);
                
        });
                
    }

    function nuevaListaPedidos(datos, mensaje = "No hay pedidos por el momento, ¡Agrega uno!"){
        $("#dgPedidos").html('');
            let contador = 0;
            
            $("#numRegistros").text(Object.keys(datos.arrPedidos).length);
            if(datos.arrPedidos.length==0){
                strHtml="<h2 class='text-center'>"+mensaje+"</h2>";
            }else{
                strHtml="";
                datos.arrPedidos.forEach(function(pedido){
                
                ++contador;
                strHtml+='<tr>';
                strHtml+='<th scope="row">'+contador+'</th>';
                strHtml+='<td id="marca'+pedido.id+'" class="idPedido d-none">'+pedido.id+'</td>';
                strHtml+='<td id="tdFecha">'+moment(pedido.fecha).format('D [de] MMMM [del] YYYY h:mm:ss A')+'</td>';
                strHtml+='<td id="tdNombre">'+pedido.nombre+' '+pedido.apellido+'</td>';
                        
                strHtml+='<td id="tdMonto">'+Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(pedido.monto)+'</td>';
                        
                strHtml+='<td id="tdStatus"><select name="estado" id="estadoPedido'+pedido.id+'" onchange="actualizarEstado('+pedido.id+')" class="form-control">';
                if(pedido.estado==1){
                    strHtml+='<option value="1" selected>ACTIVO</option>';
                }else{
                    strHtml+='<option value="1">ACTIVO</option>';
                }

                if(pedido.estado==2){
                    strHtml+='<option value="2" selected>PENDIENTE</option>';
                }else{
                    strHtml+='<option value="2">PENDIENTE</option>';
                }

                if(pedido.estado==3){
                    strHtml+='<option value="3" selected>SURTIDO</option>';
                }else{
                    strHtml+='<option value="3">SURTIDO</option>';
                }

                if(pedido.estado==4){
                    strHtml+='<option value="4" selected>FINALIZADO</option>';
                }else{
                    strHtml+='<option value="4">FINALIZADO</option>';
                }
                
                
                
                
                strHtml+='</select></td>';
                strHtml+='<td style="display:inline-block;">';
                strHtml+='<form onsubmit="return false;" style="display:inline-block;">';
                strHtml+='<input type="hidden" value="'+pedido.id+'"name="strId">';
                strHtml+='<button class="btn btn-secondary btnEditar" onclick="editarPedido('+pedido.id+')">Editar</button>';
                strHtml+='</form>';
                strHtml+='<form onsubmit="return false;" style="display:inline-block;">';
                strHtml+='<input type="hidden" value="'+pedido.id+'" name="strId">';
                strHtml+='<button class="btn btn-danger btnBorrar" onclick="borrarPedido('+pedido.id+')" id="btnEliminar">Eliminar</button>';
                strHtml+='</form>';
                strHtml+='</td>';
                strHtml+= '</tr>';
            });
            }
            
            
                    
                $("#dgPedidos").append(strHtml);
    }

    function actualizarEstado(id, estado){
        let objData={};
        objData={
            intId:id,
            intEstado: $("#estadoPedido"+id).val()
        }
        ajaxPost("http://localhost/codeigniter/pedidos/actualizarEstado", objData,
        function(data){
            
            alertify.success(data.arrMensaje[0].strMensaje);
            actualizarLista();
        });
    }

    function actualizarLista() {
        ajaxPost('http://localhost/codeigniter/pedidos/listar',{},
        function(data){ // data: respuesta del servidor
            
            nuevaListaPedidos(data);
            
            
        });
    }
    

    $("#btnAgregarCarrito").on("click", function(e){
        
        
        
        var valorMarca=$("#cmbMarca").val();
        var valorModelo=$("#cmbModelo").val();
        var nombre =$("#txtNombre").val();
        var apellido =$("#txtApellido").val();
        var domicilio =$("#txtDomicilio").val();
        var telefono =$("#txtTelefono").val();
        var status=$("#cmbEstatus").val();
        
        var errores=[];
        strHtml="";
            if(nombre==""){
                alertify.error('El nombre es requerido');
                errores.push("nombre");
            }
            if(apellido==""){
                alertify.error('El apellido es requerido');
                errores.push("apellido");
            }
            if(domicilio==""){
                alertify.error('El domicilio es requerido');
                errores.push("domicilio");
            }
            if(telefono==""){
                alertify.error('El telefono es requerido');
                errores.push("telefono");
            }
            if(status==0){
                alertify.error('El status es requerido');
                errores.push("status");
            }
            if(valorMarca==0){
                alertify.error('Por favor, elige una marca');
                errores.push("marca");
            }
            if(valorModelo==0){
                alertify.error('Por favor, elige un modelo');
                errores.push("modelo");
            }
        if(valorMarca!=0 && valorModelo!=0){
            
            if(errores.length==0){
                $("#btnAgregarCarrito").attr("disabled", "");
            $.ajax({
            url: "http://localhost/codeigniter/pedidos/obtenerModeloYMarca/"+$("#cmbModelo").val(),
            type: 'POST',
            success: function(result) {
                
                const producto ={
                    id:result.modelo.id,
                    marca:result.modelo.nombre_marca,
                    modelo:result.modelo.nombre,
                    precio:result.modelo.precio,
                    cantidad:1,
                    subTotal:result.modelo.precio,
                    iva:result.iva,
                    total:(parseFloat(result.modelo.precio))+(parseFloat(result.modelo.precio)*0.16)
                }

                console.log(producto);
                console.log(result.modelo.precio);
                console.log(result.modelo.precio*0.16);

                const existe = carrito.some(productoCarrito => productoCarrito.id === producto.id);
                if(existe){
                    //Actualizamos la cantidad
                    carrito = carrito.map(productoCarrito => {
                        if(productoCarrito.id === producto.id){
                            productoCarrito.cantidad++;
                            productoCarrito.subTotal=productoCarrito.precio*productoCarrito.cantidad;
                            productoCarrito.total=productoCarrito.subTotal + (productoCarrito.subTotal*0.16);
                            return productoCarrito; // retorna el objeto actualizado
                        }else{
                            return productoCarrito; // retorna los objetos que no son los duplicados
                        }
                    });
                    //carrito=[...productos];
                    //carrito=productos;
                }else{
                    //Agregamos elementos al arreglo de carrito
                    //articulosCarrito = [...articulosCarrito, infoCurso];
                    carrito.push(producto);
                }
                
                let totalMostrar=0; 
                
                actualizarListaCarrito();
                
                    alertify.success('¡Producto agregado a la lista!');
                    
                    $("#btnAgregarCarrito").removeAttr("disabled");
                
            }
        });
                
                
                        
        
                    
                
                
            }
            
        }        
    });
    
    
    $("#btnAtrasPedido").on("click", function(e){
        $("#divListar").toggle("fast");
        $("#divFormulario").toggle("fast");
        $("#btnAtrasPedido").toggle("fast");
        $("#btnAgregarPedido").toggle("fast");
        $(".lista").toggle("fast");
        $(".carrito").toggle("fast");
        $(".tituloPedidos").html("Listado de pedidos");
        limpiarFormulario();
        $("#cmbModelo").html("<option value='0'>[ Seleccione primero una marca ]</option>");
        $("#filtro").show();
        carrito=[];
    });
    
        let i =1;
    
    
    $(".finalizar-pedido").on("click", function(){
        if(carrito.length>=1){
            $("#cmbModelo").html("<option value='0'>[ Seleccione primero una marca ]</option>");
        }
        
        let productosJson="";
        productosJson+="{\"productos\": [";
        i=1;
        carrito.forEach(function(producto){
            if(i===carrito.length){
                productosJson+="{ \"id\": \""+producto.id+"\", \"cantidad\":\""+producto.cantidad+"\" }";
            }else{
                //productosJson+="\""+producto.id+" x"+producto.cantidad+"\", ";
                productosJson+="{ \"id\": \""+producto.id+"\", \"cantidad\":\""+producto.cantidad+"\" },";
                i++;
            }
            
            
        });

        productosJson+="]}";
        
        
        let totalMonto=0;
        carrito.forEach(producto=>{
                totalMonto+=producto.total;
        });
        $objData={
            nombre:$("#txtNombre").val(),
            apellido:$("#txtApellido").val(),
            domicilio:$("#txtDomicilio").val(),
            telefono:$("#txtTelefono").val(),
            ordenes:productosJson,
            estado:$("#cmbEstatus").val(),
            monto:totalMonto
        }
        $(".finalizar-pedido").attr("disabled", "");
        if(carrito.length==0){
            alertify.error("No puedes finalizar un pedido sin productos");
            $(".finalizar-pedido").removeAttr("disabled");
        }else{
            
            
                ajaxPost("http://localhost/codeigniter/pedidos/guardar", $objData,
                function(data){
                    $(".finalizar-pedido").removeAttr("disabled");
                    alertify.success('Pedido Guardado');
                    actualizarLista();
                    limpiarFormulario();
                    $("#cmbModelo").val("0");
                    $("#btnAtrasPedido").click();
                    carrito=[];
                });

                

                
            

            
            

            
        }
        
    });

    $("#finalizar-pedido").on("click", function(){
        let productosJson="";
        productosJson+="{\"productos\": [";
        i=1;
        carrito.forEach(function(producto){
            if(i===carrito.length){
                productosJson+="{ \"id\": \""+producto.id+"\", \"cantidad\":\""+producto.cantidad+"\" }";
            }else{
                //productosJson+="\""+producto.id+" x"+producto.cantidad+"\", ";
                productosJson+="{ \"id\": \""+producto.id+"\", \"cantidad\":\""+producto.cantidad+"\" },";
                i++;
            }
            
            
        });

        productosJson+="]}";
        
        
        let totalMonto=0;
        carrito.forEach(producto=>{
                totalMonto+=producto.total;
        });
        $objData={
            nombre:$("#txtNombre").val(),
            apellido:$("#txtApellido").val(),
            domicilio:$("#txtDomicilio").val(),
            telefono:$("#txtTelefono").val(),
            productos:productosJson,
            estado:$("#cmbEstatus").val(),
            monto:totalMonto
        }
        ajaxPost("http://localhost/codeigniter/pedidos/guardar", $objData,
        function(data){
            alertify.success('Pedido Guardado');
            actualizarLista();
            limpiarFormulario();
            $("#cmbModelo").val("0");
            $("#btnAtrasPedido").click();
            carrito=[];
        });
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

    $("#cmbMarca").on("change", function(e){
        $.ajax({
            url: "http://localhost/codeigniter/pedidos/listarModelos/"+$("#cmbMarca").val(),
            type: 'POST',
            success: function(result) {
                
                $("#cmbModelo").html("");
                if(result.arrModelos.length>0){
                    $strHtml="";
                    
                    result.arrModelos.forEach(function(modelo){
                    $("#txtModelo").val(modelo.nombre);
                    $("#txtPrecioModelo").val(modelo.precio);
                    strHtml= "<option class='optModelo' value='"+modelo.id+"'>"+modelo.nombre+" </option>";
                    $("#cmbModelo").append(strHtml);
                    });
                    
                }else{
                    $("#cmbModelo").html("<option value='0'>[ Seleccione primero una marca ]</option>");
                }

                
            }
    });
    })
    
    function limpiarHTML(){


    while(document.querySelector("#lista-carrito tbody").firstChild){
        document.querySelector("#lista-carrito tbody").removeChild(document.querySelector("#lista-carrito tbody").firstChild);
    }
    while(document.querySelector("#carritoPedido").firstChild){
        document.querySelector("#carritoPedido").removeChild(document.querySelector("#carritoPedido").firstChild);
    }

}


    

</script>