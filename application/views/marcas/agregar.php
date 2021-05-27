<div class="card">
  <h5 class="card-header"><?php if(isset($registro) or set_value("intId") !=="") echo "Editar"; else echo "Agregar"; ?> marca <a href="<?php echo 'http://localhost/codeigniter/marcas' ?>" class="btn btn-secondary float-right">Atras</a></h5>
  <div class="card-body">
    <h5 class="card-title">Listado de Marcas</h5>
    <form action="<?php echo "http://localhost/codeigniter/"?>marcas/guardar" method="POST">
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
                <option value="0" <?php if(set_value("intStatus")=="0" or (isset($registro) and $registro->status=="0")) echo "selected" ?>>[ Seleccione ]</option>
                <option value="1" <?php if(set_value("intStatus")=="1" or (isset($registro) and $registro->status=="1")) echo "selected" ?> >ACTIVO</option>
                <option value="2" <?php if(set_value("intStatus")=="2" or (isset($registro) and $registro->status=="2")) echo "selected" ?>>CANCELADO</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary float-right">Guardar</button>
        
    </form>
    
  </div>
</div>
<?php
