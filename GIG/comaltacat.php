<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
    <h1>Alta Categoria</h1>
    <label for="nom">Nombre de categoria</label>
    <input type="text" name="nom" id="nom"><br>
    <input type="submit" value="Enviar">

    <br>
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

            $nom=$_POST['nom'];
            if($nom==""){
                throw new PDOException("Tienes que rellenar el campo");
            }
            $stmtConsulta=$conn->prepare('SELECT max(ID_CATEGORIA) FROM categoria');
            $stmtConsulta->execute();
            $arrayCnsulta=$stmtConsulta->fetchColumn();
            $arrayCnsulta=substr($arrayCnsulta, 2,3);
            $numID=str_pad($arrayCnsulta+1, 3, "0",STR_PAD_LEFT);
            $idCat="C-".$numID;
            
            $stmt=$conn->prepare('INSERT INTO categoria (ID_CATEGORIA, NOMBRE) VALUE (:ID_CATEGORIA, :NOMBRE)');
            $stmt->bindParam(':ID_CATEGORIA', $idCat);
            $stmt->bindParam(':NOMBRE', $nom);
            $stmt->execute();
            
            echo "New records created successfully";
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
    }
    
    ?>
</body>
</html>