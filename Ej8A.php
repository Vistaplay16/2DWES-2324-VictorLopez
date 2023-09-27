<HTML>
<HEAD><TITLE> </TITLE></HEAD>
<BODY>
<?php
$NotasBase=array();
$NotasBase["Paco"]=8;
$NotasBase["Fernando"]=9;
$NotasBase["Luis"]=5;
$NotasBase["Omar"]=4;
$NotasBase["Ana"]=6;
$aux1=max($NotasBase);
$aux2=min($NotasBase);


foreach ($NotasBase as $key => $value) {
    if($value==$aux1){
        echo "La mayor nota es del alumno: \n".$key." es: \n".$aux1;
    }
   
}
echo "<br>";
foreach ($NotasBase as $key => $value) {
    if($value==$aux2){
        echo "La menor nota es del alumno: \n".$key." y es: \n".$aux2;
    }
}
?>
</BODY>
</HTML>