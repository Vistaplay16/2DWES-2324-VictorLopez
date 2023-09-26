<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>
    <table border="1">
        <tr>
            <td>Indice</td>
            <td>Binario</td>
            <td>Octal</td>
        </tr>
<?php
$arrayDecimales=[];
for ($i=0; $i <20; $i++) { 
    $arrayDecimales[$i]=$i;
}
$arrayBinario=[];
$cont=0;
for ($i=0; $i <20 ; $i++) { 
    $arrayBinario[$i]=decbin($arrayDecimales[$i]);
}
$arrayBinario=array_reverse($arrayBinario);
$arrayOctal=[];
for ($i=0; $i <20 ; $i++) { 
    $arrayOctal[$i]=decoct($arrayDecimales[$i]);
}

for ($i=0; $i <20 ; $i++) { 
    echo "<tr>";
    echo "<td>".$arrayDecimales[$i]."</td>";
    echo "<td>".$arrayBinario[$i]."</td>";
    echo "<td>".$arrayOctal[$i]."</td>";
    echo "</tr>";
}
?>
</table>
</BODY>
</HTML>