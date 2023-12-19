<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Alta Empleado</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <label for="dni">DNI:</label>
        <input type="text" name="dni" id="dni"><br>
        <label for="nom">Nombre Empleado:</label>
        <input type="text" name="nom" id="nom"><br>
        <label for="ape">Apellidos:</label>
        <input type="text" name="ape" id="ape"><br>
        <label for="fechaNac">Fecha de nacimiento:</label>
        <input type="date" name="fechaNac" id="fechaNac"><br>
        <label for="salario">Salario:</label>
        <input type="number" name="salario" id="salario"><br>
        <label for="fechaIni">Fecha de inicio:</label>
        <input type="date" name="fechaIni" id="fechaIni"><br>
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
<?php 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "webemple";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dni=$_POST["dni"];
        $nom=$_POST["nom"];
        $ape=$_POST["ape"];
        $fecha=$_POST["fechaNac"];
        $sal=$_POST["salario"];
        $nomDpto=$_POST["dpto"];
        $fechaIni=$_POST["fechaIni"];
        if($dni=="" || $nom=="" || $ape=="" || $fecha=="" || $sal=="" || $nomDpto=null ){
            throw new PDOException("Tienes que rellenar los campos");
        }else{

            $stmtInsertEmple=$conn->prepare("INSERT INTO empleado(dni, nombre, apellidos, fecha_nac, salario) VALUES (:dni, :nom, :ape, :fecha, :sal)");
            $stmtInsertEmple->bindParam(":dni", $dni);
            $stmtInsertEmple->bindParam(":nom", $nom);
            $stmtInsertEmple->bindParam(":ape", $ape);
            $stmtInsertEmple->bindParam(":fecha", $fecha);
            $stmtInsertEmple->bindParam(":sal", $sal);
            $stmtInsertEmple->execute();
            $stmtInsertEmple_dpto=$conn->prepare("INSERT INTO emple_depart(dni, cod_dpto, fecha_ini) VALUES (:dni, :codDpto, :fechaIni) ");
            $stmtInsertEmple_dpto->bindParam(":dni", $dni);
            $stmtInsertEmple_dpto->bindParam(":codDpto", $codDpto);
            $stmtInsertEmple_dpto->bindParam(":fechaIni", $fechaIni);
            $stmtInsertEmple_dpto->execute();


        }

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
</body>
</html>