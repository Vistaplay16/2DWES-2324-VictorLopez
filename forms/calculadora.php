<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
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
    ?>
</body>
</html>