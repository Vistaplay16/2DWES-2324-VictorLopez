<?php 
    include '../models/functionsDB.php';
    session_start();
    $matricula=$_POST['vehiculos'];
    $x=comprobarAlquilerCliente($_SESSION['idcliente'],$matricula);
    if(isset($_POST['devolver'])){
        if($x[0]['count']!=0){
            $fechaActual=date('Y-m-d H:i:s');
            $recibido=generarDiffDat($matricula, date('Y/m/d H:m:s'));
            $precio=$recibido[0]['diff']*$recibido[0]['preciobase'];
            $_SESSION['precio']=$precio;
            $_SESSION['matricula']=$matricula;
            header('Location: ../pasarela/ejemploGeneraPet');
        }else{
            $_SESSION['errorDevolver']='No tienes ese coche alquilado';
            header("Location: ../views/movdevolver.php");
        }
    }elseif (isset($_POST['volver'])) {
        $_SESSION['errorDevolver']='';
        header('Location: ../views/movwelcome.php');
    }
?>