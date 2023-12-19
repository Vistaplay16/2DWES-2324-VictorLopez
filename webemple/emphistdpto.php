<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Historico de los empleados de este departamento</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <br>
            <label for="dpto">Departamento a elegir:</label>
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
        $stmtConsEmpleDpto=$conn->prepare(" SELECT empleado.dni, empleado.nombre, empleado.apellidos, empleado.fecha_nac, empleado.salario from empleado, emple_depart WHERE emple_depart.cod_dpto=:codDpto and empleado.dni=emple_depart.dni and ISNULL(emple_depart.fecha_fin)=''");
        $stmtConsEmpleDpto->bindParam(":codDpto", $codDpto);
        $codDpto=$_POST['dpto'];
        $stmtConsEmpleDpto->execute();
        $arrayCons=$stmtConsEmpleDpto->fetchAll(PDO::FETCH_ASSOC);
        echo "<h2>Empleados</h2><br>";
        foreach ($arrayCons as $key) {
            echo "<b>DNI: </b>".$key["dni"]. ", <b>Nombre: </b>". $key["nombre"]. ", <b>Apellido: </b>". $key["apellidos"]. ", <b>Fecha de nacimiento: </b>". $key["fecha_nac"]. ",<b> Salario: </b>". $key["salario"];
        }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
</body>
</html>