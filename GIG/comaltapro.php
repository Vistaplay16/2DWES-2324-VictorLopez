<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1>Alta Producto</h1>
    <label for="nom">Nombre de producto</label>
    <input type="text" name="nom" id="nom"><br>
    <label for="precio">Precio</label>
    <input type="number" name="precio" id="precio"><br>
    <label for="categoria">Categoria</label>
    <?php 
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmtCon=$conn->prepare('SELECT * FROM categoria;');
            $stmtCon->execute();
            $arrayCon=$stmtCon->fetchAll(PDO::FETCH_ASSOC);
            echo "<select id='categoria'>";
            foreach ($arrayCon as $categoria) {
                    $idCat=$categoria["ID_CATEGORIA"];
                    $nom=$categoria["NOMBRE"];
                    echo "<option value=$idCat>$nom<option/>";
            }
            echo "<select/>";
    ?>
    <br>
    <input type="submit" value="Enviar">
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

            
            $stmt=$conn->prepare('INSERT INTO producto(ID_PRODUCTO, NOMBRE, PRECIO, ID_CATEGORIA) VALUES (:ID_PRODUCTO, :NOMBRE, :PRECIO, :ID_CATEGORIA)');
            $stmt->bindParam(':ID_PRODUCTO', $idProd);
            $stmt->bindParam(':NOMBRE', $nom);
            $stmt->bindParam(':PRECIO', $precio);
            $stmt->bindParam(':ID_CATEGORIA', $idCat);


            $stmtConsulta=$conn->prepare('SELECT * FROM producto');
            $stmtConsulta->execute();
            $arrayCnsulta=$stmtConsulta->fetchAll(PDO::FETCH_ASSOC);
            var_dump($arrayCnsulta);
            $numID=str_pad(count($arrayCnsulta)+1, 4, "0",STR_PAD_LEFT);  
            $idProd="P".$numID;

            $nom=$_POST['nom'];
            $precio=$_POST['precio'];
            $stmt->execute();
            

            echo "New records created successfully";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    
    ?>
</body>
</html>