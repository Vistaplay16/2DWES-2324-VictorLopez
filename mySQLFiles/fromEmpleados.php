<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="DNI">DNI:</label>
    <input type="text" name="DNI" id="DNI"><br>
    <label for="nombre">Nombre Empleado:</label>
    <input type="text" name="nombre" id="nombre"><br>
    <label for="salario">Salario:</label>
    <input type="text" name="salario" id="salario"><br>
    <label for="cod_dep">Codigo Departamento:</label>
    <input type="text" name="cod_dep" id="cod_dep">
    <input type="submit" value="Enviar">
    </form>


    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "empleados1n";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO empleado (dni,nombre_emple,salario,cod_dpto) VALUES (:dni,:nombre_emple,:salario,:cod_dpto)");
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':cod_dpto', $cod_dpto);
            $stmt->bindParam(':nombre_emple', $nombre);
            $stmt->bindParam(':salario', $salario);

            // insert another row
            $cod_dpto = $_POST['cod_dep'];
            $nombre = $_POST['nombre'];
            $salario=$_POST['salario'];
            $dni=$_POST['DNI'];

            $stmt->execute();
        
            echo "New records created successfully";
            }
        catch(PDOException $e)
            {
            echo "Error: " . $e->getMessage();
            }
        $conn = null;

    }
    
    ?>
</body>
</html>