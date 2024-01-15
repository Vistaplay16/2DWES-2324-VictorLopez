<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleCarrito.css">
</head>
<body>
    <div class="navbar">
        <?php 
            echo "<h2 id='subTitulo'>Carrito de  ". $_SESSION['usu']."</h2>";
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <?php 
            if(isset($_COOKIE['carrito'])){
                $cadenaCookie=$_COOKIE['carrito'];
            }else{
                header('Location: comprar.php');
            }
            $Cookies=explode(";", $cadenaCookie);
            for ($i=0; $i < count($Cookies) ; $i++) { 
                $arraycookie=explode(":",$Cookies[$i]);
                $arrayAsoc[$arraycookie[0]]=$arraycookie[1];
            }
            echo "<table border='1'>";
            echo "<tr>";
            echo "<td>";
            echo "Nombre";
            echo "</td>";
            echo "<td>";
            echo "Cantidad";
            echo "</td>";
            echo "</tr>";
            echo "<tr>";
            $servername = "localhost";
            $username = "root";
            $password = "rootroot";
            $dbname = "comprasweb";
            try{
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                foreach ($arrayAsoc as $key => $value) {
                    echo "<tr>";
                    $stmt=$conn->prepare("SELECT NOMBRE FROM producto WHERE producto.id_producto=:idProd");
                    $stmt->bindParam(":idProd", $key);
                    $stmt->execute();
                    $Nom=$stmt->fetchColumn();
                    echo "<td>";
                    echo $Nom;
                    echo "</td>";
                    echo "<td>";
                    echo $value;
                    echo "</td>";
                    echo "</tr>";
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }
            echo "</table>";
            ?>
        </form>
    </div>
</body>
</html>