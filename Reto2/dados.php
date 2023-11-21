<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./cssPHP/style.css">
</head>
<body>
    <?php 
    //RECOGIDA DE DATOS
    $jugador1=$_POST['jug1'];
    $jugador2=$_POST['jug2'];
    $jugador3=$_POST['jug3'];
    $jugador4=$_POST['jug4'];
    $numDados=$_POST['numdados'];
    $resultadoJ1=0;
    $resultadoJ2=0;
    $resultadoJ3=0;
    $resultadoJ4=0;
    $numRandJ1=array();
    $numRandJ2=array();
    $numRandJ3=array();
    $numRandJ4=array();
    // CREACION DE EXCEPCIONES PARA LOS CAMPOS 
    if(empty($jugador1) || empty($jugador2) || empty($jugador3) || empty($jugador4)){
        die("Tienen que ser 4 jugadroes obligatoriamente");
    }
    if(empty($numDados)){
        die("Numero de dados no puede estar vacio");
    }
    if($numDados<1 || $numDados>10){
        die("El numero de dados tiene que estar entre 1 y 10");
    }

    //CREACION DE LA TABLA 
    echo '<table border="1">';
    //JUGADOR 1
    echo '<tr>';
    echo '<th>'.$jugador1.'</th>';
    for ($i=0; $i < $numDados; $i++) { 
        $numRandJ1[$i]=rand(1,6);
        echo '<td>';
        imprimirFoto($numRandJ1[$i]);
        echo '</td>';
        $resultadoJ1+=$numRandJ1[$i];
    }
    //JUGADOR 2
    echo '</tr>';
    echo '<tr>';
    echo '<th>'.$jugador2.'</th>';
    for ($i=0; $i < $numDados; $i++) { 
        $numRandJ2[$i]=rand(1,6);
        echo '<td>';
        imprimirFoto($numRandJ2[$i]);
        echo '</td>';
        $resultadoJ2+=$numRandJ2[$i];
    }
    //JUGADOR 3
    echo '</tr>';
    echo '<tr>';
    echo '<th>'.$jugador3.'</th>';
    for ($i=0; $i < $numDados; $i++) { 
        $numRandJ3[$i]=rand(1,6);
        echo '<td>';
        imprimirFoto($numRandJ3[$i]);
        echo '</td>';
        $resultadoJ3+=$numRandJ3[$i];
    }
    //JUGADOR 4
    echo '</tr>';
    echo '<tr>';
    echo '<th>'.$jugador4.'</th>';
    for ($i=0; $i < $numDados; $i++) { 
        $numRandJ4[$i]=rand(1,6);
        echo '<td>';
        imprimirFoto($numRandJ4[$i]);
        echo '</td>';
        $resultadoJ4+=$numRandJ4[$i];
    }



    echo '</tr>'; 
    echo '</table>';
//ESTE IF NOS SIRVE PARA QUE SI HAN SALIDO LOS MISMOS DADOS EN UN JUGADOR O EN VARIOS, EL RESULTADO SEA 100
if($numDados!=1){
    if(elementosArrayIguales($numRandJ1)){
        $resultadoJ1=100;
    }
    if(elementosArrayIguales($numRandJ2)){
        $resultadoJ2=100;
    }
    if(elementosArrayIguales($numRandJ3)){
        $resultadoJ3=100;
    }
    if(elementosArrayIguales($numRandJ4)){
        $resultadoJ4=100;
    }
}

    //IMPRIMIMOS CADA JUGADOR CON SU RESULTADO 
    echo '<p>'.$jugador1.'='.$resultadoJ1.'</p>';
    echo '<br>';
    echo '<p>'.$jugador2.'='.$resultadoJ2.'</p>';
    echo '<br>';
    echo '<p>'.$jugador3.'='.$resultadoJ3.'</p>';
    echo '<br>';
    echo '<p>'.$jugador4.'='.$resultadoJ4.'</p>';

    // GUARDAMOS SEN UN ARRAY ASOCIATIVO TODOS LOS RESULTADOS Y CON LA FUNCION MAX GUARDAMOS EN UNA VARIABLE EL VALOR MAXIMO
    $arrayResultados=array($jugador1=>$resultadoJ1,$jugador2=>$resultadoJ2, $jugador3=>$resultadoJ3, $jugador4=>$resultadoJ4);
    $resultadoMaximo=max($arrayResultados);
    //CON UN FORECAH RECORREMOS EL ARRAY ASOCIATIVO PARA IMPIMIR LOS GANADORES Y GUARDAR EL NUMERO DE GANADORES
    $contGanadores=0;
    foreach ($arrayResultados as $key => $value) {
        if($value==$resultadoMaximo){
            echo '<p>'.'GANADOR:';
            echo $key.'</p>';
            $contGanadores+=1;
        }
    }
    //IMPRIMO EL NUMERO DE GANADORES
    echo '<p>'.$contGanadores.' ganadores.</p>';

    //AQUI EMPIEZA LA CREACION DEL ARCHIVO .TXT
    //LO GUARDAMOS EN UNA CARPETA FILES Y CON LA FUNCION FOPEN LO CREAMOS 
    $nombreArchivo='files/resultados.txt';
    $archivoTirada=fopen($nombreArchivo,'a');
    //CON LA FUNCION FWRITE ESCRIBIMOS EL JUGADOR, SU RESULTADO Y CON UN FOR LOS DADOS QUE LE HAN SALIDO, YA QUE TENIAOS ANTES CREADO EL ARRAY DE DADOS
    //ESTE PROCESO SE REPITE POR CADA JUGADOR 
    fwrite($archivoTirada, str_pad($jugador1, strlen($jugador1)+1, "#", STR_PAD_RIGHT));
    fwrite($archivoTirada, str_pad($resultadoJ1, strlen($resultadoJ1)+1, "#", STR_PAD_RIGHT));
    for ($i=0; $i < count($numRandJ1); $i++) { 
        fwrite($archivoTirada, str_pad($numRandJ1[$i],strlen($numRandJ1[$i])+1, "#", STR_PAD_RIGHT));
    }
    fwrite($archivoTirada,"\n");
    fwrite($archivoTirada, str_pad($jugador2, strlen($jugador2)+1, "#", STR_PAD_RIGHT));
    fwrite($archivoTirada, str_pad($resultadoJ2, strlen($resultadoJ2)+1, "#", STR_PAD_RIGHT));
    for ($i=0; $i < count($numRandJ2); $i++) { 
        fwrite($archivoTirada, str_pad($numRandJ2[$i],strlen($numRandJ2[$i])+1, "#", STR_PAD_RIGHT));
    }
    fwrite($archivoTirada,"\n");
    fwrite($archivoTirada, str_pad($jugador3, strlen($jugador3)+1, "#", STR_PAD_RIGHT));
    fwrite($archivoTirada, str_pad($resultadoJ3, strlen($resultadoJ3)+1, "#", STR_PAD_RIGHT));
    for ($i=0; $i < count($numRandJ3); $i++) { 
        fwrite($archivoTirada, str_pad($numRandJ3[$i],strlen($numRandJ3[$i])+1, "#", STR_PAD_RIGHT));
    }
    fwrite($archivoTirada,"\n");
    fwrite($archivoTirada, str_pad($jugador4, strlen($jugador4)+1, "#", STR_PAD_RIGHT));
    fwrite($archivoTirada, str_pad($resultadoJ4, strlen($resultadoJ4)+1, "#", STR_PAD_RIGHT));
    for ($i=0; $i < count($numRandJ4); $i++) {  
        fwrite($archivoTirada, str_pad($numRandJ4[$i],strlen($numRandJ4[$i])+1, "#", STR_PAD_RIGHT));
    }
    //LE DAMOS UNOS ESPACIOS PARA SEPARAR CADA TIRADA
    fwrite($archivoTirada,"\n");
    fwrite($archivoTirada,"\n");
    fclose($archivoTirada);

    //AQUI HE CREADO LA FUNCION IMPRIMIR FOTO PARA HACER MAS EFICIENTE EL CODIGO
    function imprimirFoto($numeroRandom){
        $dado1='./images/1.PNG';
        $dado2='./images/2.PNG';
        $dado3='./images/3.PNG';
        $dado4='./images/4.PNG';
        $dado5='./images/5.PNG';
        $dado6='./images/6.PNG';
            if($numeroRandom==1){
                echo '<img src="' . $dado1 . '" alt="Mi Imagen">';
            }else if($numeroRandom==2){
                echo '<img src="' . $dado2 . '" alt="Mi Imagen">';
            }else if($numeroRandom==3){
                echo '<img src="' . $dado3 . '" alt="Mi Imagen">';
            }else if($numeroRandom==4){
                echo '<img src="' . $dado4 . '" alt="Mi Imagen">';
            }else if($numeroRandom==5){
                echo '<img src="' . $dado5 . '" alt="Mi Imagen">';
            }else if($numeroRandom==6){
                echo '<img src="' . $dado6 . '" alt="Mi Imagen">';
            }
    }

    //ESTA FUNCION LA HE HECHO PARA 
    function elementosArrayIguales($array){
        $x=true;
        $valor1=$array[0];
        foreach ($array as $key) {
            if($valor1!=$key){
                $x=false;
            }
        }
        return $x;
    }
    ?>
</body>
</html>