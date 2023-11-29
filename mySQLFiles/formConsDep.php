<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="cod_dpto">Codigo Departamento</label><br>
    <input type="text" name="cod_dpto" id="cod_dpto"><br>
    <input type="submit" value="Enviar">
    </form>


    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "empleadosnn";
        try {
            $cod_dpto=$_POST['cod_dpto'];
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmtConsultaDpto= $conn->prepare("SELECT nombre_emple, salario, fecha_nac,fecha_ini FROM departamento, empleado, emple_dpto
            WHERE empleado.dni=emple_dpto.dni
                  AND departamento.cod_dpto=emple_dpto.cod_dpto
                  AND departamento.cod_dpto='$cod_dpto';");
            $stmtConsultaDpto->execute();
            $arrayCod_dptoDNI=$stmtConsultaDpto->fetchAll(PDO::FETCH_ASSOC);

           
            echo "<table border='1'>";
            echo "<tr>";
            foreach ($arrayCod_dptoDNI[0] as $key => $value) {
                echo "<td>";
                echo $key;
                echo "<td/>";
            } 
            echo "<tr/>";

            for ($i=0; $i <count($arrayCod_dptoDNI) ; $i++) {
                echo "<tr>";
                foreach ($arrayCod_dptoDNI[$i] as $key => $value) {
                    echo "<td>";
                    echo $value;
                    echo "<td/>";
                } 
                echo "<tr/>";
            }
            echo "<table/>";  
        }catch(PDOException $e)
            {
            echo "Error: " . $e->getMessage();
            }
        $conn = null;

    }
    
    ?>
</body>
</html>