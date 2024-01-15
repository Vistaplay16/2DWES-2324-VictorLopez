<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleCompra.css">
</head>
<body>
    <div class="navbar">
        <a href="menuCarrito.php">Ver carrito</a>
        <?php 
            echo "<h2 id='subTitulo'>Bienvenido  ". $_SESSION['usu']."</h2>";
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <label for="prod">Producto</label>
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "comprasweb";
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmt=$conn->prepare("SELECT ID_PRODUCTO, NOMBRE FROM producto");
            $stmt->execute();
            $arrayCons=$stmt->fetchAll(PDO::FETCH_ASSOC);
            echo "<select name='selProd' id='selProd'>";
            foreach ($arrayCons as $key) {
                echo "<option value=".$key["ID_PRODUCTO"].">".$key["NOMBRE"]."</option>";
            }
            echo "</select>";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        ?>
        <label for="cant">Cantidad</label>
        <input type="number" name="cant" id="cant">
        <input type="submit" value="Añadir a Carrito" id="añadir">
    </form>
    <?php 
    
    ?>

        <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "comprasweb";
        try{
            $idProd=$_POST["selProd"];
            $cant=$_POST["cant"];
            
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt=$conn->prepare("SELECT CANTIDAD from almacena WHERE almacena.ID_PRODUCTO=:idProd");
            $stmt->bindParam(":idProd", $idProd);
            $stmt->execute();
            $arrayCantProd=$stmt->fetchAll(PDO::FETCH_COLUMN);
            if($cant>$arrayCantProd[0]){
                echo "<p id='mensError'>No hay stock</p>";
                throw new PDOException;
            }else{
                $cadenaCarrito=$idProd.":".$cant;
                if(isset($_COOKIE['carrito'])){
                    $valorActual=$_COOKIE['carrito'];
                    $nCadena=$valorActual.";".$cadenaCarrito;
                    setcookie("carrito", $nCadena,time() + 3600, '/' );
                }else{
                    setcookie("carrito", $cadenaCarrito,  time() + 3600, '/');
                }
                /*
                $stmtUpdate=$conn->prepare("UPDATE almacena SET CANTIDAD=:nCant WHERE almacena.ID_PRODUCTO=:idProd");
                $stmtUpdate->bindParam(":idProd", $idProd);
                $aCant=$arrayCantProd[0];
                $nCant=$aCant-$cant;
                $stmtUpdate->bindParam(":nCant", $nCant);
                $stmtUpdate->execute();
                */
            }
        }catch(PDOException $e){
            echo $e->getMessage();
        }
        
    }
    ?>
</div>
</body>
</html>