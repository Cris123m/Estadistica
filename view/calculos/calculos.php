<?php 
require_once '../../model/notas.php';

if(isset($_REQUEST['calculo'])){
    $calculo=$_REQUEST['calculo'];
    $notas= new Notas();
    $ci=$_REQUEST['ci'];
    if($ci>50){            
        $not=$notas->ListarxEstudiante($ci);
    }else{    
        $not=$notas->ListarxMateria($ci);
    }
    
    switch ($calculo) {
        case 'moda':
            moda($not);
            break;
        case 'varianza':
            varianza($not);
            break;
        
        case 'frecuencia':
            frecuenciaAbsoluta($not);
            frecuenciaRelativa($not);
            frecuenciaAbsolutaAcumulada($not);
            frecuenciaRelativaAcumulada($not);
            break;
        
        case 'media_aritmetica':
            mediaAritmetica($not);
            break;
        
        case 'percentiles':
            percentil($not,$_REQUEST['percentil']);
            break;
        
        case 'media_geometrica':
            mediaGeometrica($not);
            break;
        
        case 'media_armonica':
            media_armonica($not);
            break;
        
        case 'frecuencia_relativa':
            graficoFRelativa($not);
            break;   
            
        case 'todo':
            moda($not);
            echo "</br>";
            varianza($not);
            echo "</br>";
            frecuenciaAbsoluta($not);
            frecuenciaRelativa($not);
            graficoFRelativa($not);
            frecuenciaAbsolutaAcumulada($not);
            frecuenciaRelativaAcumulada($not);
            mediaAritmetica($not);
            break; 

        default:
            break;
    }
}
function moda($not){    
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
            echo "$key; ";
            $valorAnterior = $valor;
        }
    }
}

function varianza($not){
    $nums = array();
    foreach ($not as $n) {
        array_push($nums,$n->nota);
    } 
    $sum=0;
    for($i=0;$i<count($nums);$i++){
        $sum+=$nums[$i];
    }
    $media = $sum/count($nums);
    $sum2=0;
    for($i=0;$i<count($nums);$i++){
        $sum2+=($nums[$i]-$media)*($nums[$i]-$media);
    }
    $vari = $sum2/count($nums);
    $sq = sqrt($vari);
    echo "La varianza es: $vari <br>";
    echo "La desviacion estandar es: ".$sq;
}

function frecuenciaAbsoluta($not){
    $division=array();
    foreach ($not as $n) {
        array_push($division,$n->nota);
    }    
    $cuenta = array_count_values($division);
    arsort($cuenta);
    //echo "<br/>Array asociativo que devuelve la función array_count_values, contine cuantas veces se repite cada valor del arry original: <br/>";
    //print_r($cuenta);
    echo "Frecuencia Absoluta </br>"
    ?>
    <table class="table table-striped">
        <tr>
            <th>Nota</th>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <th><?php echo $key; ?></th>
            <?php } ?>
        </tr>
        <tr>
            <td>fi</td>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <td><?php echo $valor; ?></td>
            <?php } ?>
        </tr>
    </table>
    <?php
}
function frecuenciaRelativa($not){
    $division=array();
    $cont=0;
    foreach ($not as $n) {
        array_push($division,$n->nota);
        $cont++;
    }    
    $cuenta = array_count_values($division);
    arsort($cuenta);
    //echo "<br/>Array asociativo que devuelve la función array_count_values, contine cuantas veces se repite cada valor del arry original: <br/>";
    //print_r($cuenta);
    echo "Frecuencia Relativa </br>"
    ?>
    <table class="table table-striped">
        <tr>
            <th>Nota</th>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <th><?php echo $key; ?></th>
            <?php } ?>
        </tr>
        <tr>
            <td>hi</td>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <td><?php echo number_format((($valor/$cont)*100), 2, '.', '')."%"; ?></td>
            <?php } ?>
        </tr>
    </table>
    <?php
}

function frecuenciaAbsolutaAcumulada($not){
    $division=array();
    foreach ($not as $n) {
        array_push($division,$n->nota);
    }    
    $cuenta = array_count_values($division);
    arsort($cuenta);
    //echo "<br/>Array asociativo que devuelve la función array_count_values, contine cuantas veces se repite cada valor del arry original: <br/>";
    //print_r($cuenta);
    $acum=0;
    echo "Frecuencia Absoluta Acumulada</br>"
    ?>
    <table class="table table-striped">
        <tr>
            <th>Nota</th>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <th><?php echo $key; ?></th>
            <?php } ?>
        </tr>
        <tr>
            <td>fi</td>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <td><?php echo $valor; ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td>Fi</td>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <td><?php $acum+=$valor ;echo $acum; ?></td>
            <?php } ?>
        </tr>
    </table>
    <?php
}

function frecuenciaRelativaAcumulada($not){
    $division=array();
    $cont=0;
    foreach ($not as $n) {
        array_push($division,$n->nota);
        $cont++;
    }    
    $cuenta = array_count_values($division);
    arsort($cuenta);
    //echo "<br/>Array asociativo que devuelve la función array_count_values, contine cuantas veces se repite cada valor del arry original: <br/>";
    //print_r($cuenta);
    $acum=0;
    echo "Frecuencia Relativa Acumulada</br>"
    ?>
    <table class="table table-striped">
        <tr>
            <th>Nota</th>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <th><?php echo $key; ?></th>
            <?php } ?>
        </tr>
        <tr>
            <td>hi</td>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <td><?php echo number_format((($valor/$cont)*100), 2, '.', '')."%"; ?></td>
            <?php } ?>
        </tr>
        <tr>
            <td>Hi</td>
            <?php foreach ($cuenta as $key => $valor) { ?>
                <td><?php $acum+=$valor;echo number_format((($acum/$cont)*100), 2, '.', '')."%"; ?></td>
            <?php } ?>
        </tr>
    </table>
    <?php
}

function mediaAritmetica($not){
    $suma=0;
    $acum=0;
    foreach ($not as $n) {
        $suma+=$n->nota;
        $acum++;
    }   
    $ma=$suma/$acum;
    echo "La Media Aritmética es: ".$ma;
}

function percentile($not, $percentile){ 
    $array=array();
    foreach ($not as $n) {
        array_push($array,$n->nota);
    } 
    sort($array);
    $index = ($percentile/100) * count($array);
    if (floor($index) == $index) {
         $result = ($array[$index-1] + $array[$index])/2;
    }
    else {
        $result = $array[floor($index)];
    }
    echo "Percentil: ".$result;
} 

function percentil($not,$percentil){
    $array=array();
    $n=0;//Almacena la cantidad de notas
    foreach ($not as $no) {
        array_push($array,$no->nota);
        $n++;
    } 
    sort($array);
    //var_dump($array);
    $lk=($n+1)*($percentil/100);
    $sup=ceil($lk);//superior
    $inf=floor($lk);//inferior
    $p=$array[$inf-1]+($lk-$inf)*($array[$sup-1]-$array[$inf-1]);
    echo "El percentil ".$percentil." es: ".$p;
}
function mediaGeometrica($not){
    $array=array();
    $n=0;//Almacena la cantidad de notas
    foreach ($not as $no) {
        array_push($array,$no->nota);
        $n++;
    } 
    $mult=1;
    foreach ($array as $a) {
        $mult=$mult*$a;
    }
    $mg=pow($mult,(1/$n));
    echo "La media geométrica es: ".$mg;
}

function media_armonica($not){
    $array=array();
    $n=0;//Almacena la cantidad de notas
    foreach ($not as $no) {
        array_push($array,(1/$no->nota));
        $n++;
    } 
    $sum=0;
    foreach ($array as $a) {
        $sum+=$a;
    }
    $ma=$n/$sum;
    echo "La media armónica es: ".$ma;
}

function graficoFRelativa($not){
    $division=array();
    $cont=0;
    foreach ($not as $n) {
        array_push($division,$n->nota);
        $cont++;
    }    
    $cuenta = array_count_values($division);
    arsort($cuenta);
    //echo "<br/>Array asociativo que devuelve la función array_count_values, contine cuantas veces se repite cada valor del arry original: <br/>";
    //print_r($cuenta);
    echo "Frecuencia Relativa </br>";
    ?>
    
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Nota', 'fi'],
          <?php foreach ($cuenta as $key => $valor): ?>
          ['<?php echo $key; ?>', <?php echo (($valor/$cont)*100); ?>],
            <?php endforeach; ?>
        ]);

        var options = {
          chart: {
            title: 'Frecuencia Relativa',
            width: 700,
            height: 400,
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
      <div id="columnchart_material"></div>
    <?php
}
?>
