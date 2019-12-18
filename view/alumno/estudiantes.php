<h1 class="page-header">Estudiantes</h1>

<div class="well well-sm text-right">
    <a class="btn btn-primary" href="?c=estudiantes&a=CRUD">Nuevo Estudiante</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="width:180px;">Nombre</th>
            <th>Apellido</th>
            <?php 
            foreach ($mat->Listar() as $m):
                ?>
                <th> <div class="Rotate-90"><?php echo $m->Materias; ?></div></th>
                <?php
            endforeach;
            ?>
        </tr> 
    </thead>
    <tbody>
      <tr>
          <td></td>
          <td></td>
          <?php 
          foreach ($mat->Listar() as $m):
              ?>
              <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#calculoModal" data-whatever="<?php echo $m->Materias.':'.$m->id;?>">C</button></td> 
              <?php
          endforeach;
          ?>
      </tr> 
    <?php 
    foreach($alm->Listar() as $r): ?>
        <tr>
            <td><?php echo $r->Nombre; ?></td>
            <td><?php echo $r->Apellido; ?></td>
            <?php 
              $notas=$not->ListarxEstudiante($r->ci);
              foreach ($mat->Listar() as $m) {
                foreach ($notas as $n) {
                  if($n->id_materia==$m->id){
                    echo "<td>$n->nota</td>";
                  }
                }
                
              }
            ?>   
            <td><button type="button" class="btn btn-success" data-toggle="modal" data-target="#calculoModal" data-whatever="<?php echo $r->Nombre.' '.$r->Apellido.':'.$r->ci;?>">Cálculos</button></td>      
            <td> <a href="?act=editar&ci=<?php echo $r->ci; ?>" class="btn btn-primary">Editar</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table> 
<!--Modals-->

<!-- Modal Botones -->
<div class="modal fade" id="calculoModal" tabindex="-1" role="dialog" aria-labelledby="calculoModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="calculoModalLabel">New message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#resultadoModal" data-whatever="moda">Moda</button>
        <button type="button" class="btn btn-outline-secondary" data-toggle="modal" data-target="#resultadoModal" data-whatever="varianza">Varianza</button>
        <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#resultadoModal" data-whatever="frecuencia">Frecuencia</button>
        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#resultadoModal" data-whatever="media_aritmetica">Media Aritmética</button>
        <button type="button" class="btn btn-outline-warning" data-toggle="modal" data-target="#percentilModal" data-whatever="percentiles">Percentiles</button>
        <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#resultadoModal" data-whatever="media_geometrica">Media Geométrica</button>
        <button type="button" class="btn btn-outline-dark" data-toggle="modal" data-target="#resultadoModal" data-whatever="media_armonica">Media Armónica</button>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#resultadoModal" data-whatever="frecuencia_relativa">Frecuencia Relativa (Gráfico)</button>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#resultadoModal" data-whatever="todo">Todo</button>
        <input type="hidden" name="cedula" id="cedula" value=""/>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Send message</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Editar -->
<?php 
if(isset($_REQUEST['gnotas'])){
  foreach ($mat->Listar() as $m){
    $notE= new Notas();
    $notE->id_materia=$m->id;
    $notE->nota=$_REQUEST[$m->id];
    $notE->ci=$_REQUEST['ci'];
    $band=false;
    foreach ($not->ListarxEstudiante($notE->ci) as $ne) {      
      if($ne->id_materia==$m->id){
        $band=true;
      }
    }
    if(!$band){
      $notE->Registrar($notE);
    }else{
      $notE->ActualizarxEstudiante($notE);
    }    
  }
}else{
  if(isset($_REQUEST['ci']) && isset($_REQUEST['act'])){
    if($_REQUEST['act']=="editar"){
    ?>
    <script type="text/javascript">
       $(document).ready(function () {
          $("#editarModal").modal('show');
      });
    </script>
    <?php
    }
  }
}

?>
<!-- Modal -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarModalTitle">Notas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="POST">
      <div class="modal-body">        
            <div class="row">
                <?php foreach ($mat->Listar() as $m): ?>
                <?php $band=false;$nota="";
                if(isset($_REQUEST['ci'])){
                  $notas=$not->ListarxEstudiante($_REQUEST['ci']);                  
                    foreach ($notas as $n) {
                      if($n->id_materia==$m->id){
                        $nota=$n->nota;
                        $band=true;
                      }
                    }   
                } ?>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label"><?php echo $m->Materias; ?></label>
                        <input type="text" class="form-control" id="recipient-name" name="<?php echo $m->id; ?>" value="<?php if ($band){echo $nota;} ?>">
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" name="gnotas">Guardar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Resultados -->
<div class="modal fade bd-example-modal-lg" id="resultadoModal" tabindex="-1" role="dialog" aria-labelledby="resultadoModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resultadoModalTitle">Notas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="resultadoCalculo"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Percentil -->
<div class="modal fade bd-example-modal-sm" id="percentilModal" tabindex="-1" role="dialog" aria-labelledby="percentilModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="percentilModalTitle">Notas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="">
      <div class="modal-body">        
        <label for="percentil" class="col-form-label">Ingrese percentil</label>
        <input type="text" class="form-control" id="percentil" name="percentil" value="">  
        <input type="hidden" name="cedulap" id="cedulap" value=""/>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#resultadoModal" data-whatever="percentiles">Calcular</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="assets/js/modal.js"></script>