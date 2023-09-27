<HTML>
<HEAD><TITLE> </TITLE></HEAD>
<BODY>
<?php
$array1=array("Bases Datos", "Entornos Desarrollo", "Programación");
$array2=array("Sistemas Informáticos","FOL");
$array3=array("Desarrollo Web ES", "Desarrollo Web EC", "Despliegue", "Desarrollo Interfaces", "Inglés");

$arrayUnir2=array_merge($array1,$array2,$array3);
$arrayUnir2=array_reverse($arrayUnir2);

var_dump($arrayUnir2);
?>
</BODY>
</HTML>