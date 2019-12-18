<?php
require_once 'model/estudiantes.php';

class EstudiantesController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Estudiante();
    }
    
    public function Index(){
        require_once 'model/materias.php';
        require_once 'model/notas.php';
        $alm = new Estudiante();
        $mat = new Materia();
        $not= new Notas();
        require_once 'view/header.php';
        require_once 'view/alumno/estudiantes.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $alm = new Estudiante();
        
        if(isset($_REQUEST['ci'])){
            $alm = $this->model->Obtener($_REQUEST['ci']);
        }
        
        require_once 'view/header.php';
        require_once 'view/alumno/estudiantes-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $alm = new Estudiante();
        
        $alm->ci = $_REQUEST['ci'];
        $alm->Nombre = $_REQUEST['Nombre'];
        $alm->Apellido = $_REQUEST['Apellido'];
        $this->model->Registrar($alm);

        /*$alm->ci > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
        */
        header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['ci']);
        header('Location: index.php');
    }
}