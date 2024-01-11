<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1>Consulta de Almacenes</h1>
    <label for="nom">Almacen</label>
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt=$conn->prepare("SELECT LOCALIDAD, NUM_ALMACEN FROM almacen");
    $stmt->execute();
    $arrayAlma=$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<select id='alma' name='alma'>";
    foreach($arrayAlma as $key){
        $numAlma=$key['NUM_ALMACEN'];
        $loc=$key['LOCALIDAD'];
        echo "<option value=".$numAlma.">".$numAlma."-".$loc."</option>";
    }
    echo "</select>";
    ?>
    <input type="submit" value="Enviar">
    <a href="./comaprpro.php">Aprovisionar Productos</a>
    <br>
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

            $numAlma=$_POST['alma'];
            $stmt=$conn->prepare('SELECT CANTIDAD, NOMBRE, PRECIO, ID_CATEGORIA from producto,almacena where almacena.num_almacen=:num_alma AND almacena.id_producto=producto.id_producto;');
            $stmt->bindParam(":num_alma", $numAlma);
            $stmt->execute();
            $arrayCnsulta=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<table border=1>";
            echo "<tr>";
            echo "<td>Cantidad</td>";
            echo "<td>Nombre</td>";
            echo "<td>Precio</td>";
            echo "<td>Categoria</td>";
            foreach($arrayCnsulta as $key){
                echo "<tr>";
                echo "<td>". $key["CANTIDAD"]."</td>";
                echo "<td>". $key["NOMBRE"]."</td>";
                echo "<td>". $key["PRECIO"]."</td>";
                echo "<td>". $key["ID_CATEGORIA"]."</td>";
                echo "</tr>";
            }
            echo "</table>"; 
            
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
    }
    
    ?>
</body>
</html>