<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre"><br>
    <label for="Cod_Dep">Codigo Departamento</label><br>
    <input type="text" name="Cod_Dep" id="Cod_Dep"><br>
    <input type="submit" value="Enviar">
    </form>


    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "empleadosnn";
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO departamento (cod_dpto,nombre_dpto) VALUES (:cod_dpto,:nombre_dpto)");
            $stmt->bindParam(':cod_dpto', $cod_dpto);
            $stmt->bindParam(':nombre_dpto', $nombre);
          
            // insert another row
            $cod_dpto = $_POST['Cod_Dep'];
            $nombre = $_POST['nombre'];
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