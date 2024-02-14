<?php 
    include '../models/functionsDB.php';
    session_start();
    $matricula=$_POST['vehiculos'];
    $x=comprobarAlquilerCliente($_SESSION['idcliente'],$matricula);
    if($x[0]['count']!=0){
        $fechaActual=date('Y-m-d H:i:s');
        $recibido=generarDiffDat($matricula, '2021-03-04 12:00:00');
        $precio=$recibido[0]['diff']*$recibido[0]['preciobase'];
        header('Location: ../pasarela/ejemploGeneraPet');
    }else{
        $_SESSION['errorDevolver']='No tienes ese coche alquilado';
        header("Location: ../views/movdevolver.php");
    }
?>