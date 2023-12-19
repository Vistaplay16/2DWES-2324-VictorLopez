<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #valorRango{
            width:5%;
        }
    </style>
</head>
<body>
    <h1>Modificar salario</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        <br>
            <label for="dpto">Empleado a elegir:</label>
            <?php 
             include './funciones.php';
             $arrayDatosServ=datosServer("webemple");
             try{
                 $conn = new PDO("mysql:host=$arrayDatosServ[0];dbname=$arrayDatosServ[1]", $arrayDatosServ[2], $arrayDatosServ[3]);
                 $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                 $stmtConsDpto=$conn->prepare("SELECT * FROM empleado");
                 $stmtConsDpto->execute();
                 $arrayConsDpto=$stmtConsDpto->fetchAll(PDO::FETCH_ASSOC);
    
                 echo "<select id='emp' name='emp'>";
                 foreach ($arrayConsDpto as $key) {
                    $nombre=$key["nombre"];
                    $dni=$key["dni"];
                    echo "<option value=".$dni.">".$nombre."</option>";
                 }
                 echo "</select>";
    
                }catch(PDOException $e){
                    echo "Error: " . $e->getMessage();
            }
            ?>
            <br>
            <label for="cambioSal">Porcentaje para modificar salario: </label>
            <br>
            <input type="range" name="rangoInput" id="rangoInput" min="-100" max="100" step="1">
            <p>Valor selecionado: <input type="number" id="valorRango" name="valorRango">
            <br>
            <input type="submit" value="Enviar">
        </form>
        <script>
            document.getElementById("rangoInput").addEventListener("change", mostrarValor);
            document.getElementById("valorRango").addEventListener("change", cambiarValor);
            function mostrarValor(){
                var valorRango=document.getElementById("rangoInput").value
                document.getElementById("valorRango").value=valorRango;
            }
            function cambiarValor(){
                var valorInput=document.getElementById("valorRango").value;
                document.getElementById("rangoInput").value=valorInput;
            }
        </script>
<br>

<a href="./empaltadpto.php">Alta Departamento</a>
<a href="./empaltaemp.php">Alta Empleado</a>
<br>
    <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $arrayDatosServ=datosServer("webemple");
    try{
        $conn = new PDO("mysql:host=$arrayDatosServ[0];dbname=$arrayDatosServ[1]", $arrayDatosServ[2], $arrayDatosServ[3]);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $dni=$_POST['emp'];
        $stmtConsSal=$conn->prepare("SELECT salario from empleado WHERE empleado.dni=:dni");
        $stmtConsSal->bindParam(":dni", $dni);
        $stmtConsSal->execute();
        $arrayCons=$stmtConsSal->fetchAll(PDO::FETCH_COLUMN);
        $porce=$_POST['valorRango'];
        $salarioAct=$arrayCons[0];

        $salarioNuevo=$salarioAct+($salarioAct *$porce/100);
        $stmtUpdate=$conn->prepare("UPDATE empleado Set salario=:salario WHERE empleado.dni=:dni");
        $stmtUpdate->bindParam(":dni", $dni);
        $stmtUpdate->bindParam(":salario", $salarioNuevo);
        $stmtUpdate->execute();
        echo "El salario ha sido cambiado"; 

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>
</body>
</html>