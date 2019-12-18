<?php 
require_once '../../model/notas.php';
if(isset($_REQUEST['ci'])){
    $ci=$_REQUEST['ci'];
    $notas= new Notas();
    $not=$notas->ListarxEstudiante($ci);
    $division=array();
    foreach ($not as $n) {
        array_push($division,$n->nota);
    }    
    $cuenta = array_count_values($division);
    arsort($cuenta);
    //echo "<br/>Array asociativo que devuelve la función array_count_values, contine cuantas veces se repite cada valor del arry original: <br/>";
    //print_r($cuenta);

    echo "La moda es: ";
    $valorAnterior = 0;
    foreach ($cuenta as $key => $valor) {
        if($valor < $valorAnterior) {
            break; 
        } else {
            echo "$key";
            $valorAnterior = $valor;
        }
    }
}
?>