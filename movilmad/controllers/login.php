<?php
include '../models/functionsDB.php';
include '../controllers/functions.php';
include  '../views/functionsViews.php';
    $email=$_POST['email'];
    $id=$_POST['password'];
    $email=test_input($email);
    $id=test_input($id);
    $resultado=consultaUsuario($email, $id);
    
    if(empty($resultado)){
        header('Location: ../views/movlogin.php');
        mensajeError('No existe el usuario');
    }else{
        session_start();
        $_SESSION['nombre']= $resultado[0]['nombre'];
        $_SESSION['idcliente']= $resultado[0]['idcliente'];
        $_SESSION['apellido']=$resultado[0]['apellido'];
        header('Location: ../views/movwelcome.php');
    }
?>