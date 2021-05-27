<div class="card">
  <h5 class="card-header">Marcas <a href="<?php echo 'http://localhost/codeigniter/marcas/agregar' ?>" class="btn btn-primary float-right">Agregar nueva marca</a></h5>
  <div class="card-body">

  
    <h5 class="card-title">Listado de Marcas</h5>
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
        
          foreach($arrMarcas as $key => $value){?>
            <tr>
            <th scope="row"><?=$value->id?></th>
            <td><?=$value->nombre?></td>
            <td><?=$value->status?></td>
            <td style="display:inline-block;">
            <form action="http://localhost/codeigniter/marcas/editar/" method="post" style="display:inline-block;">
              <input type="hidden" value="<?=$value->strId?>" name="strId">
              <button type="submit" class="btn btn-secondary">Editar</button>
            </form>
            <form action="http://localhost/codeigniter/marcas/borrar/" method="post" onsubmit="if(!confirm('Eliminar?')) return false;" style="display:inline-block;">
              <input type="hidden" value="<?=$value->strId?>" name="strId">
              <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>
            </td>
            </tr>
        <?php  }
        ?>
            
           
            
            
        </tbody>
    </table>
    <hr>
    <div class="row">
          <div class="col-12">
            <p class="float-right"><b><?php echo count($arrMarcas); ?></b> Registros</p>
          </div>
    </div>
    
  </div>
</div>
<?php



?>