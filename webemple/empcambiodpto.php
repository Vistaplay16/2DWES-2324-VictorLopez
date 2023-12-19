<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cambio de Dpto</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <br>
        <label for="dni">DNI</label>
        <?php 
         $servername = "localhost";
         $username = "root";
         $password = "rootroot";
         $dbname = "webemple";
         try{
             $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
             $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
             $stmtConsEmpl=$conn->prepare("SELECT * FROM empleado");
             $stmtConsEmpl->execute();
             $arrayConsEmpl=$stmtConsEmpl->fetchAll(PDO::FETCH_ASSOC);
             
             echo "<select id='dni' name='dni'>";
             foreach ($arrayConsEmpl as $key) {
                 $dni=$key["dni"];
                 echo "<option value=".$dni.">".$dni."</option>";
                }
                echo "</select>";
                
            }catch(PDOException $e){
                echo "Error: " . $e->getMessage();
            }
            ?>
        <br>
            <label for="dpto">Departamento a cambiar</label>
            <?php 
             $servername = "localhost";
             $username = "root";
             $password = "rootroot";
             $dbname = "webemple";
             try{
                 $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                 $stmtConsDpto=$conn->prepare("SELECT * FROM DEPARTAMENTO");
                 $stmtConsDpto->execute();
                 $arrayConsDpto=$stmtConsDpto->fetchAll(PDO::FETCH_ASSOC);
    
                 echo "<select id='dpto' name='dpto'>";
                 foreach ($arrayConsDpto as $key) {
                    $nombre=$key["nombre_dpto"];
                    $codDpto=$key["cod_dpto"];
                    echo "<option value=".$codDpto.">".$nombre."</option>";
                 }
                 echo "</select>";
    
                }catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
            }
            ?>
            <br>
        <input type="submit" value="Enviar">
    </form>

    <a href="./empaltadpto.php">Alta Departamento</a>
    <a href="./empaltaemp.php">Alta Empleado</a>
    <br>
<?php 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "webemple";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmtConsEmpleDpto=$conn->prepare(" SELECT departamento.cod_dpto from departamento, emple_depart where departamento.cod_dpto=emple_depart.cod_dpto and emple_depart.dni=:dni");
        $stmtConsEmpleDpto->bindParam(":dni", $dni);
        $stmtConsEmpleDpto->execute();
        $arrayConsEmpleDpto=$stmtConsEmpleDpto->fetchAll(PDO::FETCH_COLUMN);
        $dni=$_POST["dni"];
        $codDpto=$_POST["dpto"];
        if($dni=="" || $codDpto=="" ){
            throw new PDOException("Tienes que rellenar los campos");
        }else if($arrayConsEmpleDpto[0]==$codDpto){ 
            throw new PDOException("Ese empleado ya en ese departamento");
        }else{
            $stmtUpdate=$conn->prepare("UPDATE emple_depart SET cod_dpto=:codDpto WHERE dni=:dni");
            $stmtUpdate->bindParam(":codDpto", $codDpto);
            $stmtUpdate->bindParam(":dni", $dni);
            $stmtUpdate->execute();
            echo "El departamento ha sido cambiado";
        }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
</body>
</html>