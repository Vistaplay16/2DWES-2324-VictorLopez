<HTML>
<HEAD><TITLE> EJ2-Direccion Red – Broadcast y Rango</TITLE></HEAD>
<BODY>

<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
    <label for="direccionIP">DireccionIP</label>
    <input type="text" id="direccionIP" name="direccionIP"><br>

    <button id="Calcular" type="submit" >Calcular</button><br>

    <label for="Resultado">Resultado</label><br>
</form>
<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $direccionIP=$_POST["direccionIP"];
    $ip=explode(".",$direccionIP);
    $ipBin=" ";
    $aux=0;
    for($i=0;$i<4;$i++){
        $aux=intval($ip[$i]);
        $ipBin+=strval(decbin($aux));
    }
    echo $ipBin;    
}
?>
</BODY>
</HTML>