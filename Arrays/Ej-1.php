<HTML>
<HEAD><TITLE>Arrays</TITLE></HEAD>
<BODY>
<?php
$arrayPrimos=[];
$cont=0;
for ($i=2; $i <= 40 ; $i+++) { 
    if(Primos($i)){
        $arrayPrimos[$cont]=$i;
        $cont=$cont+1;
    }
}
var_dump($arrayPrimos);

function Primos($numero){
    $aux=true;
    for($i=2;$i<=$numero;$i++){
        if($numero%$i==0){
            $aux=false;
            break;
        }
    }
    return $aux;
}
?>
</BODY>
</HTML>