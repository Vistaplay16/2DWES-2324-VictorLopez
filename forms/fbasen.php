<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cambio de base</h1>
    <p>Introduce el unmero a convertir y la base en la que esta este numero:</p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="NumeroBase">Numero</label><br>
        <input type="text" name="NumeroBase" id="NumeroBase"><br>

        <label for="base">Nueva Base</label><br>
        <input type="number" name="base" id="base"><br>

        <input type="submit" value="Enviar Base"><br>
        <input type="reset" value="Borrar">
    </form> 
    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $Cadena=$_POST['NumeroBase'];
        if(strpos($Cadena, "/")!=false){
            $NºyBase=explode("/", $Cadena);
            $Numero=$NºyBase[0];
            $Base=$NºyBase[1];
            $NuevaBase=$_POST['base'];
            $NumeroConvertido=base_convert($Numero, $Base, $NuevaBase);
            echo "Numero ".$Numero." en base ".$Base."= ".$NumeroConvertido." en base: ".$NuevaBase;
        }else{
            echo "Tienes mal el numero o la base";
        }
    }

?>
</body>
</html>