<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Alta Departamento</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <label for="nom">Nombre Departamento:</label>
        <input type="text" name="nom" id="nom"><br>
        <input type="submit" value="Enviar">
    </form>
    <a href="./empaltaemp.php">Alta Empleado</a>
<?php 

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "webemple";
    try{
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmtInsert=$conn->prepare("INSERT INTO departamento(cod_dpto, nombre_dpto) VALUES (:codDpto, :nom)");
        $stmtInsert->bindParam(":codDpto", $codDpto);
        $stmtInsert->bindParam(":nom", $nom);

        $stmtCons=$conn->prepare("SELECT * FROM departamento");
        $stmtCons->execute();
        $arrayConsulta=$stmtCons->fetchAll(PDO::FETCH_ASSOC);
        $numCodDpto=str_pad(count($arrayConsulta)+1,  3, "0",STR_PAD_LEFT);
        $codDpto="D".$numCodDpto;
        $nom=$_POST["nom"];
        if($nom==""){
            throw new PDOException("Tienes que rellenar los campos");
        }else{
            $stmtInsert->execute();
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
</body>
</html>