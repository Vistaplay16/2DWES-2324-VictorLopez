<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    $nombre=$_POST['Nombre'];
    $apellido1=$_POST['Apellido1'];
    $apellido2=$_POST['Apellido2'];
    $email=$_POST['email'];
    $sexo=$_POST['genero'];
    $apellidos=$apellido1." ".$apellido2;
    $enclace="./datos.html";
    if($nombre==null){
        echo "No has puesto nombre, vuelve <br>";
        echo '<a href="'.$enclace.'">Regresar</a>';
    }else if($email==null){
        echo "No has puesto el email, vuelve <br>";
        echo '<a href="'.$enclace.'">Regresar</a>';
    }else if($sexo==null){
        echo "No has puesto tu sexo, vuelve <br>";
        echo '<a href="'.$enclace.'">Regresar</a>';

    }else{

    echo "<table border='1'>";
    echo "<tr>";
    echo "<td>Nombre</td>";
    echo "<td>Apellidos</td>";
    echo "<td>Email</td>";
    echo "<td>Sexo</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>$nombre</td>";
    echo "<td>$apellidos</td>";
    echo "<td>$email</td>";
    echo "<td>$sexo</td>";
    echo "</tr>";
    echo "</table>";
    }
    ?>
</body>
</html>