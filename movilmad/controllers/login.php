<?php

include '../controllers/functions.php';

    $email=$_POST['email'];
    $id=$_POST['password'];
    $email=test_input($email);
    $id=test_input($id);

    include '../models/functionsDB.php';
    $resultado=consultaUsuario($email, $id);
    

    if(empty($resultado)){
        header('Location: ../views/movlogin.php');
    }else{
        session_start();
        $_SESSION['nombre']= $resultado[0]['nombre'];
        $_SESSION['idcliente']= $resultado[0]['idcliente'];
        $_SESSION['apellido']=$resultado[0]['apellido'];
        header('Location: ../views/movwelcome.php');
    }
?>