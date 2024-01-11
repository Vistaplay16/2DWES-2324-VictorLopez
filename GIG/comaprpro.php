<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1></h1>
    <labelAprovisionar Productos for="prod">Nombre Producto</label>
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt=$conn->prepare("SELECT NOMBRE,ID_PRODUCTO FROM producto");
    $stmt->execute();
    $arrayProd=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<select id='lisProd' name='lisProd'>";
    foreach ($arrayProd as $key) {
        $nom=$key["NOMBRE"];
        $id=$key["ID_PRODUCTO"];
        echo "<option value=".$id.">".$nom."</option>";
    }
    echo "</select>";

    ?>
    <br>
    <label for="prod">Numero de Almacen</label>
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt=$conn->prepare("SELECT NUM_ALMACEN FROM almacen;");
    $stmt->execute();
    $arrayProd=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<select id='lisAlma' name='lisAlma'>";
    foreach ($arrayProd as $key) {
        $id=$key["NUM_ALMACEN"];
        echo "<option value=".$id.">".$id."</option>";
    }
    echo "</select>";
    ?>
    <br>
    <label for="cant">Cantidad de productos que se almacenan</label>
    <input type="number" name="cant" id="cant"><br>
    <input type="submit" value="Enviar">
    <a href="./comconstock.php">Consulta de stock</a>
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

            $num_alma=$_POST['lisAlma'];
            $id_prod=$_POST['lisProd'];
            $cant=$_POST['cant'];

            $stmt=$conn->prepare('INSERT INTO almacena(NUM_ALMACEN, ID_PRODUCTO, CANTIDAD) VALUES (:num_alma, :id_prod, :cant) ');
            $stmt->bindParam(":num_alma", $num_alma);
            $stmt->bindParam(":id_prod", $id_prod);
            $stmt->bindParam(":cant", $cant);

            if($cant==""){
                throw new PDOException("Tienes que rellenar todos los campos");
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