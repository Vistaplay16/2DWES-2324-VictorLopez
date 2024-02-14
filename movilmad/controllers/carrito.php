<?php
session_start();
include '../models/functionsDB.php';
include '../views/functionsViews.php';
if(isset($_POST['agregar'])){
    if(count(explode('//', $_COOKIE['Carrito']))<=3){
        $vehiculo=$_POST['vehiculos'];
        setcookie('Carrito', $_COOKIE['Carrito'].'//'.$vehiculo, time()+3600, '/');  //Guardamos el vehículo en una cookie para poder acceder a él desde cualquier
    }else{

    }
    header('Location: ../views/movalquilar.php');
}elseif (isset($_POST['vaciar'])) {
    setcookie('Carrito', '', time()+3600, '/' );
    header('Location: ../views/movalquilar.php');
}elseif (isset($_POST['alquilar'])) {
    $recibido=consultaVehiculosAlquilados($_SESSION['idcliente']);
    if(count($recibido)<=3){
        $matriculas=explode('//', $_COOKIE['Carrito']);
        $x=true;
        for ($i=0; $i < count($matriculas); $i++) { 
            if(consultaDisponibilidadCoche($matriculas[$i]=='N')){
                $x=false;
                $matricula=$matriculas[$i];
                break;
            }
        }
        if($x==true){
            alquilarCoche($_SESSION['idcliente'], $_COOKIE['Carrito']);
            setcookie('Carrito', '', time()+3600, '/' );
            header('Location: ../views/movalquilar.php');
        }else{
            mensajeError('No puedes alquilar el coche con matricula: '. $matricula .' ya que está alquilado.');
        }
    }else{
        mensajeError('No puedes tener mas de tres coches alquilados');
    }
}




?>