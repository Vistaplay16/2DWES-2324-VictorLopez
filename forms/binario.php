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
    $NºBinario=decbin($NºDecimal);

    echo "<input type='text' value='$NºBinario'>";
    /*function limpiarCadena($cadena){
        $cadena=trim($cadena);
        $cadena=htmlspecialchars($cadena);
        $cadena=stripcslashes($cadena);
        return $cadena;
    }*/
    ?>
</body>
</html>