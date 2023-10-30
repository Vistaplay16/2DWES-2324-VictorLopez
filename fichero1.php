<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre"><br>

    <label for="apellido1">Apellido 1</label><br>
    <input type="text" name="apellido1" id="apellido1"><br>

    <label for="apellido2">Apellido 2</label><br>
    <input type="text" name="apellido2" id="apellido2"><br>

    <label for="fechaNacimiento">Fecha de Nacimiento</label><br>
    <input type="text" name="fechaNacimiento" id="fechaNacimiento"><br>

    <label for="localidad">Localidad</label><br>
    <input type="text" name="localidad" id="localidad"><br>
    <br>
    <br>
    <input type="submit" value="Enviar">
    </form>

    <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){
    $nombre=$_POST['nombre'];
    $apellido1=$_POST['apellido1'];
    $apellido2=$_POST['apellido2'];
    $fechaNacimiento=$_POST['fechaNacimiento'];
    $localidad=$_POST['localidad'];
    $ficheroAlumnos=fopen('files/alumnos1.txt', 'a');
    
    fwrite($ficheroAlumnos, str_pad($nombre, 40," ", STR_PAD_RIGHT));
    fwrite($ficheroAlumnos, str_pad($apellido1, 40," ", STR_PAD_RIGHT));
    fwrite($ficheroAlumnos, str_pad($apellido2, 40," ", STR_PAD_RIGHT));
    fwrite($ficheroAlumnos, str_pad($fechaNacimiento, 9," ", STR_PAD_RIGHT));
    fwrite($ficheroAlumnos, str_pad($localidad, 26," ", STR_PAD_RIGHT));

    
    
    }
    
    ?>
</body>
</html>