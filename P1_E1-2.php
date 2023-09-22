<HTML>
<HEAD><TITLE> EJ1-Conversion IP Decimal a Binario </TITLE></HEAD>
<BODY>
<?php
$ip1="192.18.16.204";
$ipBin=str_replace(".","", $ip1);
printf("La ip es:". $ip1." , y la ip en binario es: ". decbin($ipBin));
echo "<br>";
$ip2="10.33.161.2";
$ipBin=str_replace(".","", $ip2);

echo "La ip es:". $ip2." , y la ip en binario es: ". decbin($ipBin);
?>
</BODY>
</HTML>