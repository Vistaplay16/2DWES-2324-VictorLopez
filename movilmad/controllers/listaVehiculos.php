<?php 
function devolverLista(){
    include '../models/functionsDB.php';
    $recibido=consultaMatriculaModeloMarca();
    return $recibido;
}

?>
