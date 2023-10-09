<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $NºDecimal=$_POST['NºDecimal'];
    if($_POST['base']=='Binario'){
        $NºBinario=decbin($NºDecimal);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Binario</td>";
        echo "<td>$NºBinario</td>";
        echo "</tr>";
        echo "</table>";
    }
    if($_POST['base']=='Octal'){
        $NºOctal=decoct($NºDecimal);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Octal</td>";
        echo "<td>$NºOctal</td>";
        echo "</tr>";
        echo "</table>";
    }
    if($_POST['base']=='Hexadecimal'){
        $NºHexadecimal=dechex($NºDecimal);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Hexadecimal</td>";
        echo "<td>$NºHexadecimal</td>";
        echo "</tr>";
        echo "</table>";
    }
    if($_POST['base']=='Todos'){
        $NºHexadecimal=dechex($NºDecimal);
        $NºOctal=decoct($NºDecimal);
        $NºBinario=decbin($NºDecimal);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>Binario</td>";
        echo "<td>$NºBinario</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Octal</td>";
        echo "<td>$NºOctal</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>Hexadecimal</td>";
        echo "<td>$NºHexadecimal</td>";
        echo "</tr>";
        echo "</table>";
    }
    
    ?>

    
</body>
</html>