<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="DNI">DNI:</label>
    <input type="text" name="DNI" id="DNI"><br>
    <label for="nombre">Nombre Empleado:</label>
    <input type="text" name="nombre" id="nombre"><br>
    <label for="salario">Salario:</label>
    <input type="text" name="salario" id="salario"><br>
    <label for="fecha_nac">Fecha Nacimiento:</label>
    <input type="date" name="fecha_nac" id="fecha_nac"><br>
    <label for="cod_dpto">Codigo Departamento: </label>
    <input type="text" name="cod_dpto" id="cod_dpto"><br>
    <label for="fecha_ini">Fecha de inicio</label>
    <input type="date" name="fecha_ini" id="fecha_ini"><br>
    <input type="submit" value="Enviar">
    </form>


    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "empleadosnn";
        try {
            $fecha_nac = $_POST['fecha_nac'];
            $nombre = $_POST['nombre'];
            $salario=$_POST['salario'];
            $dni=$_POST['DNI'];
            $cod_dpto=$_POST['cod_dpto'];
            $fehca_ini=$_POST['fecha_ini'];
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            //guardar los codigos de departamento en un array
            $stmtConsulta= $conn->prepare("SELECT cod_dpto FROM departamento;");
            $stmtConsulta->execute();
            $arrayCod_dpto=$stmtConsulta->fetchAll(PDO::FETCH_COLUMN);
            

            // prepare sql and bind parameters
            $stmt = $conn->prepare("INSERT INTO empleado (dni,nombre_emple,salario,fecha_nac) VALUES (:dni,:nombre_emple,:salario,:fecha_nac);
                                    INSERT INTO emple_dpto (dni, cod_dpto,fecha_ini) VALUES (:dni,:cod_dpto,:fecha_ini)");
            $stmt->bindParam(':dni', $dni);
            $stmt->bindParam(':nombre_emple', $nombre);
            $stmt->bindParam(':salario', $salario);
            $stmt->bindParam(':fecha_nac', $fecha_nac);
            $stmt->bindParam(':fecha_ini', $fehca_ini);
            $x=false;
            for ($i=0; $i <count($arrayCod_dpto) ; $i++) { 
                if($arrayCod_dpto[$i]==$cod_dpto){
                    $x=true;
                }
            }
            if($x){
                $stmt->bindParam(':cod_dpto', $cod_dpto);
            }else{
                throw new PDOException("El departamento no existe");
            }
            // insert a row
            $stmt->execute();
            

            
            echo "New records created successfully";
            }
        catch(PDOException $e)
            {
            echo "Error: " . $e->getMessage();
            }
        $conn = null;

    }
    
    ?>
</body>
</html>