<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1>Consulta de Stock</h1>
    <label for="prod">Selecciona el nombre del producto:</label>
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
    <label for="prod">Selecciona el numero de almacen:</label>
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
    <a href="./comaprpro">Aprovisionar Productos</a>
    <input type="submit" value="Enviar">
    </form>
    <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    }
    
    ?>
</body>
</html>