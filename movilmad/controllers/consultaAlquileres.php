<?php 
function hacerConsulta(){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        include '../models/functionsDB.php';
        $fechaIni=$_POST['fechadesde'];
        $fechaFin=$_POST['fechahasta'];
        $recibido=consultaAlquilerVehiculos($_SESSION['idcliente'], $fechaIni, $fechaFin);
        return  $recibido;
    }else{
        $arrayError[0]='Error en el método de solicitud';
        return $arrayError;
    }
}
?>