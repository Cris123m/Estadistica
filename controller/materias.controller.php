<?php
require_once 'model/materias.php';

class MateriasController{
    
    private $model;
    
    public function __CONSTRUCT(){
        $this->model = new Materia();
    }
    
    public function Index(){
        $alm = new Materia();
        require_once 'view/header.php';
        require_once 'view/alumno/Materias.php';
        require_once 'view/footer.php';
    }
    
    public function Crud(){
        $alm = new Materia();
        
        if(isset($_REQUEST['ci'])){
            $alm = $this->model->Obtener($_REQUEST['ci']);
        }
        
        require_once 'view/header.php';
        require_once 'view/materias/Materias-editar.php';
        require_once 'view/footer.php';
    }
    
    public function Guardar(){
        $alm = new Materia();
        
        $alm->ci = $_REQUEST['ci'];
        $alm->Nombre = $_REQUEST['Nombre'];
        $alm->Apellido = $_REQUEST['Apellido'];
        

        $alm->ci > 0 
            ? $this->model->Actualizar($alm)
            : $this->model->Registrar($alm);
        
        header('Location: index.php');
    }
    
    public function Eliminar(){
        $this->model->Eliminar($_REQUEST['ci']);
        header('Location: index.php');
    }

    public function Notas(){
        require_once 'view/header.php';
        require_once 'view/materias/materias-notas.php';
        require_once 'view/footer.php';
    }
}