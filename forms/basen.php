<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $Cadena=$_POST['NumeroBase'];
    if(strpos($Cadena, "/")!=false){
        $NºyBase=explode("/", $Cadena);
        $Numero=$NºyBase[0];
        $Base=$NºyBase[1];
        $NuevaBase=$_POST['base'];
        echo $Numero."<br>";
        echo $Base."<br>";
        echo $NuevaBase."<br>";
        $NumeroConvertido=base_convert($Numero, $Base, $NuevaBase);
        echo "Numero ".$Numero." en base ".$Base."= ".$NumeroConvertido." en base: ".$NuevaBase;
    }else{
        echo "Tienes mal el numero o la base";
    }
 

?>
</body>
</html>