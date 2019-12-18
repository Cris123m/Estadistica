<h1 class="page-header">
    <?php echo $alm->ci != null ? $alm->Nombre : 'Nuevo Registro'; ?>
</h1>

<ol class="breadcrumb">
  <li><a href="?c=Estudiantes">Estudiantes</a></li>
  <li class="active"><?php echo $alm->ci != null ? $alm->Nombre : 'Nuevo Registro'; ?></li>
</ol>

<form ci="frm-estudiante" action="?c=Estudiantes&a=Guardar" method="post" enctype="multipart/form-data">
    <input type="hidden" name="ci" value="<?php echo $alm->ci; ?>" />
    
    <div class="form-group">
        <label>Cédula de identidad</label>
        <input type="text" name="ci" value="" class="form-control" placeholder="Ingrese la cédula" data-validacion-tipo="requerido|min:3" />
    </div>
    <div class="form-group">
        <label>Nombre</label>
        <input type="text" name="Nombre" value="<?php echo $alm->Nombre; ?>" class="form-control" placeholder="Ingrese el nombre del estudiante" data-validacion-tipo="requerido|min:3" />
    </div>
    
    <div class="form-group">
        <label>Apellido</label>
        <input type="text" name="Apellido" value="<?php echo $alm->Apellido; ?>" class="form-control" placeholder="Ingrese el apellido del estudiante" data-validacion-tipo="requerido|min:10" />
    </div>
    
   
    
    <hr />
    
    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>

<script>
    $(document).ready(function(){
        $("#frm-estudiante").submit(function(){
            return $(this).validate();
        });
    })
</script>