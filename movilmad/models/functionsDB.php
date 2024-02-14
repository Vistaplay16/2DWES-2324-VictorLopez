<?php 
function ConexSer($nom){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = $nom;
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}

function consultaUsuario($email, $id){
    try{
    $conn=ConexSer('movilmad');
    $stmt=$conn->prepare('SELECT email, idcliente, nombre, apellido FROM rclientes WHERE email=:email  AND idcliente=:pss');
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pss', $id);
    $stmt->execute();
    $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $resultado;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function consultaMatriculaModeloMarca(){
    try{
        $conn=ConexSer('movilmad'); 
        $stmt=$conn->prepare('SELECT matricula,marca, modelo FROM rvehiculos');
        $stmt->execute();
        $resultado=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }  
}

function consultaVehiculosAlquilados($id){
    try{
    $conn=ConexSer('movilmad');    
    $consulta=$conn->prepare('SELECT count(*) FROM ralquileres WHERE idcliente=:id');
    $consulta->bindParam(':id', $id);
    $consulta->execute();
    $cantidad=$consulta->fetch();
    return  $cantidad;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }  
}


function alquilarCoche($id, $Matriculas){
    try{
        $fecha_actual=date("Y-m-d H:i:s");
        $conn=ConexSer('movilmad');
        $matriculas=explode('//', $Matriculas);
        for ($i=1; $i <count($matriculas) ; $i++) {
            $stmt=$conn->prepare('INSERT INTO ralquileres(idcliente, matricula, fecha_alquiler) VALUES (:id, :matr, :fec)');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':matr',$matriculas[$i]);
            $stmt->bindParam(':fec', $fecha_actual);
            $stmt->execute();
        }
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }  
}
function consultaDisponibilidadCoche($matricula){
    try{
    $conn=ConexSer('movilmad');
    $stmt=$conn->prepare('SELECT disponible FROM rvehiculos WHERE  matricula = :matricula');
    $stmt->bindParam(':matricula',$matricula);
    $stmt->execute();
    $disp=$stmt->fetch();
    return $disp;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }  
}


function consultaAlquilerVehiculos($id, $fecha_ini, $fecha_fin){
    try{
        $conn=ConexSer('movilmad');
        $stmt=$conn->prepare('SELECT rvehiculos.matricula,rvehiculos.marca,rvehiculos.modelo,ralquileres.fecha_alquiler,ralquileres.fecha_devolucion,ralquileres.preciototal  FROM ralquileres, rvehiculos WHERE idcliente=:id AND ralquileres.matricula=rvehiculos.matricula AND fecha_alquiler>:fechIni AND fecha_devolucion<:fechFin ORDER BY ralquileres.fecha_alquiler ASC ');
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':fechIni', $fecha_ini);
        $stmt->bindParam(':fechFin', $fecha_fin);
        $stmt->execute();
        $respuesta= $stmt->fetchAll(PDO::FETCH_ASSOC);
        $cont=0;
        /*foreach ($respuesta as $key ) {
            $cont++;
            $fecha_iniBase=new DateTime($key['fecha_alquiler']);
            $fecha_finBase=new DateTime($key['fecha_devolucion']);
            if($fecha_ini<$fecha_iniBase  || $fecha_fin>$fecha_finBase){
                $posicionBorrar=$cont;
            }
        }*/
        //unset($respuesta[$posicionBorrar-1]);
        return $respuesta;
    }catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }  
}
/*SELECT rvehiculos.matricula,rvehiculos.marca,rvehiculos.modelo,ralquileres.fecha_alquiler,ralquileres.fecha_devolucion,ralquileres.preciototal  FROM ralquileres, rvehiculos WHERE idcliente=:id AND ralquileres.matricula=rvehiculos.matricula ORDER BY ralquileres.fecha_alquiler ASC*/

function comprobarAlquilerCliente($id, $matricula){
    try{
        $conn=ConexSer('movilmad');
        $stmt=$conn->prepare('SELECT COUNT(*) AS count FROM ralquileres  WHERE matricula = :matr AND idcliente = :id');
        $stmt->bindParam(':matr', $matricula);
        $stmt->bindParam(':id', $id);
        $stmt->execute(); 
        $respuesta=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}

function generarDiffDat($matricula, $fechaActual){
    try{
        $conn=ConexSer('movilmad');
        $stmt=$conn->prepare('SELECT TIMESTAMPDIFF(MINUTE, fecha_alquiler, :fechAct) AS diff,preciobase  FROM ralquileres, rvehiculos WHERE ralquileres.matricula=:matr AND rvehiculos.matricula=:matr');
        $stmt->bindParam(':fechAct', $fechaActual);
        $stmt->bindParam(':matr', $matricula);
        $stmt->execute(); 
        $respuesta=$stmt->fetchAll(PDO::FETCH_ASSOC);
        return $respuesta;
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
}
?>