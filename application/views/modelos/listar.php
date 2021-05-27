<?php
    //echo "Exito = $intExito <br>";
?>

<div class="card">
  <h5 class="card-header">Modelos</h5>
  <div class="card-body">
    <form action="<?php echo "http://localhost/codeigniter/"?>modelos" method="POST">
        <?php echo form_error('intMarcaId'); ?>
        <div class="form-group">
                <label for="cmbMarca">Marca</label>
                <select name="intMarcaId" id="cmbMarca" class="form-control" onchange="submit()">
                    <option value="0">[ Seleccione ]</option>
                    <?php 
            
                    foreach($arrMarcas as $key => $value){?>
                        
                        <option value="<?=$value->id?>" <?php if($value->id == $intMarcaId) echo "selected" ?> ><?=$value->nombre?> </option>
                <?php   }
            ?>
                </select>
        </div>
    </form>
    <div class="row">
        <div class="col-2 col-sm-6 col-md col-lg-4">
            <div class="card">
                <h5 class="card-header"><?php if(isset($registro) or set_value("intId") !=="") echo "Editar"; else echo "Agregar"; ?> Modelo</h5>
                <div class="card-body">
                    <h5 class="card-title">Listado de Modelos</h5>
                    <form action="<?php echo "http://localhost/codeigniter/"?>modelos/guardar" method="POST">
                        <input type="hidden" name="intMarcaId" value="<?=$intMarcaId?>">
                        <div class="form-group">
                            <label for="txtId">ID</label>
                            <input name="intId" type="text" class="form-control" id="txtId" placeholder="[Nuevo]" readonly="" value="<?php if($intExito) echo set_value('intId') ?><?php if(isset($registro)) echo $registro->id; ?>">
                            
                        </div>
                        <?php echo form_error('strNombre'); ?>
                        <div class="form-group">
                            <label for="txtNombre">Nombre</label>
                            <input name="strNombre" type="text" class="form-control" id="txtNombre" placeholder="Ingrese el nombre" value="<?php if($intExito) echo set_value('strNombre'); ?><?php if(isset($registro)) echo $registro->nombre ?>"<?php if($intMarcaId == 0) echo "disabled"; ?>>
                        </div>
                        <?php echo form_error('strDescripcion'); ?>
                        <div class="form-group">
                            <label for="txtNombre">Descripcion</label>
                            <textarea name="strDescripcion" class="form-control" id="txtDescripcion" cols="30" rows="10" placeholder="Ingrese una descripcion" <?php if($intMarcaId == 0) echo "disabled"; ?>><?php if($intExito) echo set_value("strDescripcion") ?><?php if(isset($registro)) echo $registro->descripcion ?></textarea>
                        </div>
                        <?php echo form_error('intStatus'); ?>
                        <div class="form-group">
                            <label for="cmbEstatus">Estatus</label>
                            <select name="intStatus" id="cmbEstatus" class="form-control" 
                            <?php if($intMarcaId == 0) echo "disabled"; ?>>
                                <option value="0" <?php if(($intExito && set_value("intStatus")=="0") or (isset($registro) and $registro->status=="0")) echo "selected" ?>>[ Seleccione ]</option>
                                <option value="1" <?php if(($intExito && set_value("intStatus")=="1") or (isset($registro) and $registro->status=="1")) echo "selected" ?> >ACTIVO</option>
                                <option value="2" <?php if(($intExito && set_value("intStatus")=="2") or (isset($registro) and $registro->status=="2")) echo "selected" ?>>CANCELADO</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary float-right"
                        <?php if($intMarcaId == 0) echo "disabled"; ?>>Guardar</button>
                        
                    </form>
                    
                </div>
            </div>
        </div>
        <div class="col-6">
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col" width="120px">Status</th>
                    <th scope="col" width="200px">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                $arrMarcas=[];
                foreach($arrModelos as $key => $value){?>
                    <tr>
                    <th scope="row"><?=$value->id?></th>
                    <td><?=$value->nombre?></td>
                    <td><?=$value->status?></td>
                    <td style="display:inline-block;">
                    <form action="http://localhost/codeigniter/modelos/editar/" method="post" style="display:inline-block;">
                    <input type="hidden" value="<?=$intMarcaId?>" name="intMarcaId">
                    <input type="hidden" value="<?=$value->strId?>" name="strId">
                    <button type="submit" class="btn btn-secondary">Editar</button>
                    </form>
                    <form action="http://localhost/codeigniter/modelos/borrar/" method="post"
                       onsubmit="if(!confirm('Eliminar?')) return false;" style="display:inline-block;">
                    <input type="hidden" value="<?=$intMarcaId?>" name="intMarcaId">
                    <input type="hidden" value="<?=$value->strId?>" name="strId">
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                    </td>
                    </tr>
                <?php }
                ?>
                    
                
                    
                    
                </tbody>
            </table>
            <hr>
            <div class="row">
                <div class="col-12">
                    <p class="float-right"><b><?php echo count($arrModelos); ?></b> Registros</p>
                </div>
            </div>
        </div>
    </div>
   
    
    
    
  </div>
</div>
