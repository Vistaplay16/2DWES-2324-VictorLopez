<?php 
function devolverLista($disp){
    include '../models/functionsDB.php';
    $recibido=consultaMatriculaModeloMarca($disp);
    return $recibido;
}

?>
