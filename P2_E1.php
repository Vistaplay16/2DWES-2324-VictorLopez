<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
<?php
$num="1";
$numBin="";
$resto=$num;
if($num==0){
    $numBin=0;
}
while($num>=1){
    $bit=$num%2;
    $numBin=$bit. $numBin;
    $num=$num/2;
}
echo $numBin;
?>
</BODY>
</HTML>