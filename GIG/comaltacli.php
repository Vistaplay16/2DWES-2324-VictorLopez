<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleReg.css">
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <h1>Alta de clientes</h1>
        <label for="NIF">NIF:</label>
        <input type="text" name="NIF" id="NIF"><br>
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre"><br>
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido"><br>
        <label for="codPos">Codigo Postal</label>
        <input type="number" name="codPos" id="codPos"><br>
        <label for="dir">Direccion</label>
        <input type="text" name="dir" id="dir"><br>
        <label for="ciudad">Ciudad</label>
        <input type="text" name="ciudad" id="ciudad"><br>

    
    <input type="submit" value="Enviar">
    </form>
    <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        include 'comregcli.php';
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "comprasweb";
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $nif=$_POST["NIF"];
            $nom=$_POST["nombre"];
            $ape=$_POST["apellido"];
            $codPos=$_POST["codPos"];
            $dir=$_POST["dir"];
            $ciu=$_POST["ciudad"];

            $stmtCon=$conn->prepare("SELECT NIF FROM CLIENTE");
            $stmtCon->execute();
            $arrayCons=$stmtCon->fetchAll(PDO::FETCH_COLUMN);
            $stmtIns=$conn->prepare("INSERT INTO cliente (NIF, NOMBRE, APELLIDO, CP, DIRECCION, CIUDAD, usuario, contrasena) VALUES (:nif, :nom, :ape, :codPos, :dir, :ciu, :usu, :pss);");
            $x=false;
            for ($i=0; $i <count($arrayCons) ; $i++) { 
                if($arrayCons[$i]==$nif){
                    $x=true;    
                }
            }
            if($x){
                throw new PDOException("No puedes meter un NIF ya existente");
            }else if($nif=="" ||$nom=="" ||$ape=="" ||$codPos=="" ||$dir=="" ||$ciu==""){
                echo "Tienes que rellenar todos los campos";
            }else{
                $stmtIns->bindParam(":nif", $nif);
                $stmtIns->bindParam(":nom", $nom);
                $stmtIns->bindParam(":ape", $ape);
                $stmtIns->bindParam(":codPos", $codPos);
                $stmtIns->bindParam(":dir", $dir);
                $stmtIns->bindParam(":ciu", $ciu);
                $stmtIns->bindParam(":usu", $nom);
                $apeRev=strrev($ape);
                $stmtIns->bindParam(":pss",$apeRev);
                $stmtIns->execute();
                crearCookie($nom, strrev($ape));
            }
            header('Location: comlog.php');
        
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
        $conn=null;
    }
    
    ?>
</body>
</html>