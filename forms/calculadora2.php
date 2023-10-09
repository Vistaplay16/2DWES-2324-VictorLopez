<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="operando1">Operando1:</label>
        <input type="number" name="operando1" id="operando1"><br>

        <label for="operando2">Operando2</label>
        <input type="number" name="operando2" id="operando2"><br>

        <label for="selecciona">Selecciona Operacion</label><br>
        <input type="radio"  checked name="operador" value="suma" >Suma <br>
        <input type="radio" name="operador" value="resta">Resta <br>
        <input type="radio" name="operador" value="multiplicacion"> Multiplicacion <br>
        <input type="radio" name="operador" value="division"> Division <br>
         
        <input type="submit" value="Enviar">
        <input type="reset" value="Borrar">
    </form>
    <?php 
    if( (isset($_POST['operador']) && isset($_POST['operando1']) && isset($_POST['operando2']))){
    echo "El resultado de la operacion es: <br>";
    if($_POST['operador']=='suma'){
        echo $_POST["operando1"]+ $_POST["operando2"];
    }
    if($_POST['operador']=='resta'){
        echo $_POST["operando1"]- $_POST["operando2"];
    }
    if($_POST['operador']=='multiplicacion'){
        echo $_POST["operando1"]* $_POST["operando2"];
    }
    if($_POST['operador']=='division'){
        echo $_POST["operando1"]/ $_POST["operando2"];
    }
}
    ?>
</body>
</html>