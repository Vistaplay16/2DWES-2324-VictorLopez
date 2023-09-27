<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php
$array1=array("Bases Datos", "Entornos Desarrollo", "Programación");
$array2=array("Sistemas Informáticos","FOL","Mecanizado");
$array3=array("Desarrollo Web ES", "Desarrollo Web EC", "Despliegue", "Desarrollo Interfaces", "Inglés");
$arrayUnir1=$arrayUnir2=$arrayUnir3=[];
foreach ($array1 as $key) {
    $arrayUnir1[].=$key;
}
foreach ($array2 as $key) {
    $arrayUnir1[].=$key;
}
foreach ($array3 as $key) {
    $arrayUnir1[].=$key;
}
var_dump($arrayUnir1);

$arrayUnir2=array_merge($array1,$array2,$array3);

var_dump($arrayUnir2);
array_push($arrayUnir3, $array1, $array2, $array3);
var_dump($arrayUnir3);
?>
</BODY>
</HTML>