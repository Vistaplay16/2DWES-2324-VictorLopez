<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1>Alta Almacen</h1>
    <label for="loc">Localidad</label>
    <input type="text" name="loc" id="loc"><br>
    <br>
    <input type="submit" value="Enviar"><br>
    <a href="./comaltapro.php">Alta producto</a>
    </form>
    <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "comprasweb";
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            
            $stmt=$conn->prepare('INSERT INTO almacen(localidad) VALUE (:localidad)');
            $stmt->bindParam(":localidad", $loc);

            $loc=$_POST['loc'];
            if($loc==""){
                throw new PDOException("Tienes que rellenar el campo");
            }
            $stmt->execute();

            echo "New records created successfully";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    
    ?>
</body>
</html>