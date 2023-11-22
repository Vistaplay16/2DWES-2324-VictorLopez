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
    $jugador1_1=$_POST['jug1'];
    $jugador2_2=$_POST['jug2'];
    $jugador3_3=$_POST['jug3'];
    $jugador4_4=$_POST['jug4'];
    $numDados=$_POST['numdados'];

    //LIMPIAR DATOS
    $jugador1=test_input($jugador1_1);
    $jugador2=test_input($jugador2_2);
    $jugador3=test_input($jugador3_3);
    $jugador4=test_input($jugador4_4);
    $numDados=test_input($numDados);

    // CREACION DE EXCEPCIONES PARA LOS CAMPOS
    try{
        if(empty($jugador1) || empty($jugador2) || empty($jugador3) || empty($jugador4)){
            throw new Exception("Tienen que ser 4 jugadroes obligatoriamente");
        }
        if(empty($numDados)){
            throw new Exception("Numero de dados no puede estar vacio");
        }
        if($numDados<1 || $numDados>10){
            throw new Exception("El numero de dados tiene que estar entre 1 y 10");
        }
    }catch(Exception $e){
        echo "Error: ". $e->getMessage();
        return;
    }

    /*LA TABLA FUNCIONA DE MANERA QUE TODOS LOS DATOS DE LA MISMA SE GUARDAN EN UN SOLO ARRAY, ES DECIR,
    SE CREA UN ARRAY ASOCIATIVO EN EL QUE CADA POSICION CORRESPONDE A CADA JUGADOR Y EN CADA POSICION SE GUARDAN
    LOS DADOS QUE LE HAN SALIDO A CADA JUGADOR
    */
    //CREACION DE ARRAY ASOCIATIVOS
    $arrayTiradas=array();
    $arrayResultados=array();
    //CREACION DE LA TABLA 
    echo '<table border="1">';
    //JUGADOR 1
    $arrayResTir=imprimirJugador($jugador1, $numDados);
    $arrayResultados[$jugador1]=$arrayResTir[0];
    $arrayTiradas=array_merge($arrayTiradas,$arrayResTir[1]);
    //JUGADOR 2
    $arrayResTir=imprimirJugador($jugador2, $numDados);
    $arrayResultados[$jugador2]=$arrayResTir[0];
    $arrayTiradas=array_merge($arrayTiradas,$arrayResTir[1]);
    //JUGADOR 3
    $arrayResTir=imprimirJugador($jugador3, $numDados);
    $arrayResultados[$jugador3]=$arrayResTir[0];
    $arrayTiradas=array_merge($arrayTiradas,$arrayResTir[1]);
    //JUGADOR 4
    $arrayResTir=imprimirJugador($jugador4, $numDados);
    $arrayResultados[$jugador4]=$arrayResTir[0];
    $arrayTiradas=array_merge($arrayTiradas,$arrayResTir[1]);
    echo '</table>';


    //IMPRIMIMOS CADA JUGADOR CON SU RESULTADO 
    echo '<p>'.$jugador1.'='.$arrayResultados[$jugador1].'</p>';
    echo '<br>';
    echo '<p>'.$jugador2.'='.$arrayResultados[$jugador2].'</p>';
    echo '<br>';
    echo '<p>'.$jugador3.'='.$arrayResultados[$jugador3].'</p>';
    echo '<br>';
    echo '<p>'.$jugador4.'='.$arrayResultados[$jugador4].'</p>';



    //CON LA FUNCION MAX GUARDAMOS EN UNA VARIABLE EL VALOR MAXIMO DE LOS RESULTADOS
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
    $archivoTirada=fopen($nombreArchivo,'w');
    //CON LA FUNCION FWRITE ESCRIBIMOS EL JUGADOR, SU RESULTADO Y CON UN FOR LOS DADOS QUE LE HAN SALIDO, YA QUE TENIAOS ANTES CREADO EL ARRAY DE DADOS
    //ESTE PROCESO SE REPITE POR CADA JUGADOR 
    
    guardarDatosJugadorTXT($arrayTiradas,$jugador1,$arrayResultados[$jugador1],$archivoTirada);

    guardarDatosJugadorTXT($arrayTiradas,$jugador2,$arrayResultados[$jugador2],$archivoTirada);

    guardarDatosJugadorTXT($arrayTiradas,$jugador3,$arrayResultados[$jugador3],$archivoTirada);

    guardarDatosJugadorTXT($arrayTiradas,$jugador4,$arrayResultados[$jugador4],$archivoTirada);

    
    //LE DAMOS UNOS ESPACIOS PARA SEPARAR CADA TIRADA
    fclose($archivoTirada);



    //AQUI HE CREADO LA FUNCION IMPRIMIR FOTO 
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

    //ESTA FUNCION LA HE HECHO PARA VER SI LO ELEMENTOS DEL ARRAY SON IGUALES
    function elementosArrayIguales($array){
        return count(array_unique($array)) === 1;
    }



    //ESTA FUNCION IMPRIME LOS DATOS DE UN JUGADOR (LOS DADOS QUE LE HAN SALIDO CON SU NOMBRE) 
    //SOLO HAY QUE PASARLE POR PARAMETRO EL NOMBRE DEL JUGADOR Y LOS DADOS QUE HAY QUE TIRAR
    /*DEVUELVE UN ARRAY QUE CONTIENE , EN LA PRIMERA POSICION, EL RESULTADO DEL JUGADOR Y, EN LA SEGUNDA POSICION, 
    UN ARRAY QUE CONTIENE EL NOMBRE DEL JUGADOR Y LOS DADOS CORRESPONDIENTES
    */
    function imprimirJugador($jugador, $numDados){
        echo '<tr>';
        echo '<th>' . $jugador . '</th>';
        $resultadoJugador = 0;
        for ($i = 0; $i < $numDados; $i++) {
            $numRand[$i] = rand(1, 6);
            echo '<td>';
            imprimirFoto($numRand[$i]);
            echo '</td>';
            $resultadoJugador += $numRand[$i];
        }
        echo '</tr>';
        $tiradas[$jugador]=$numRand;

        if($numDados!=1){
            if(elementosArrayIguales($numRand)){
                $resultadoJugador=100;
            }
        }
        
        $arrayReturn=[$resultadoJugador, $tiradas];
        return $arrayReturn;
    }


    //ESTA FUNCION ME GUARDA TODOS LOS DATOS DE LOS JUGADORES EN UN ARCHIVO TXT YA CREADO FUERA DE LA FUNCION
    function guardarDatosJugadorTXT($arrayTirada, $jugador, $resultado, $archivoTirada){
        fwrite($archivoTirada, str_pad($jugador, strlen($jugador)+1, "#", STR_PAD_RIGHT));
    fwrite($archivoTirada, str_pad($resultado, strlen($resultado)+1, "#", STR_PAD_RIGHT));
    foreach ($arrayTirada[$jugador] as $value) {
        fwrite($archivoTirada, str_pad($value,strlen($value)+1, "#", STR_PAD_RIGHT));
    }
    fwrite($archivoTirada,"\n");

    }


    function test_input($cadena) {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = htmlspecialchars($cadena);
        return $cadena;
    }    
    
    ?>
</body>
</html>