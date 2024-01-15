<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h1>Alta de clientes</h1>   
        <br>
        <label for="idProd">Id Producto</label>
        <?php 
         $servername = "localhost";
         $username = "root";
         $password = "rootroot";
         $dbname = "comprasweb";
         try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmtCon=$conn->prepare("SELECT ID_PRODUCTO FROM producto");
            $stmtCon->execute();
            $arrayCons=$stmtCon->fetchAll(PDO::FETCH_COLUMN);
            echo "<select id='idProd'>";
            for ($i=0; $i < count($arrayCons) ; $i++) { 
                echo "<option value=".$arrayCons[$i].">".$arrayCons[$i]."</option>"; 
            }
            echo "</select>";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
        
        ?>
        <?php 
         $servername = "localhost";
         $username = "root";
         $password = "rootroot";
         $dbname = "comprasweb";
         try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $stmtCon=$conn->prepare("SELECT CANTIDAD FROM ALMACENA, PRODUCTO WHERE ID_PRODUCTO==");
            $stmtCon->execute();
            $arrayCons=$stmtCon->fetchAll(PDO::FETCH_COLUMN);
            echo "<select id='idProd'>";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
        
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
            $fechaActual = new DateTime(); 

            $cadenaFecha =  $fechaActual->format('d/m/Y');
            echo $cadenaFecha;
            $nif=$_POST["nif"];
            $idProd=$_POST['idProd'];
            
            $stmtIns=$conn->prepare("INSERT INTO compras (NIF, ID_PRODUCTO, FECHA_COMPRA, UNIDADES) VALUES (:nif, :idProd, :fechaCom, :uni);");
            
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
    }
    
    ?>
</body>
</html>