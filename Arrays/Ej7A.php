<HTML>
<HEAD><TITLE> </TITLE></HEAD>
<BODY>
<?php
$alumnos=array();
$alumnos["Paco"]=array("Paco", 20);
$alumnos["Fernando"]=array("Fernando",20);
$alumnos["Luis"]=array("Luis",19);
$alumnos["Omar"]=array("Omar",19);
$alumnos["Ana"]=array("Ana",18);

$mode=current($alumnos);
print_r($mode);
echo "<br>";

$mode=next($alumnos);
print_r($mode);
echo "<br>";

$mode=end($alumnos);
print_r($mode);
echo "<br><br>";
foreach ($alumnos as $key => $valor) {
    echo $alumnos[$key][0]."\n";
    echo $alumnos[$key][1]."<br>";
}

asort($alumnos,0);
var_dump($alumnos);
?>
</BODY>
</HTML>