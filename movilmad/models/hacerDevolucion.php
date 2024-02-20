<?php 
    try{
        session_start();
        include './functionsDB.php';
        include '../pasarela/apiRedsys.php';
        $miObj = new RedsysAPI;
        $datos=$_GET["Ds_MerchantParameters"];
        $decodec = $miObj->decodeMerchantParameters($datos);
        $data=json_decode(urldecode($decodec), true);
        $precio=strval($data['Ds_Amount']/100);
        $conn=ConexSer('movilmad');
        $stmtFechaDev=$conn->prepare("UPDATE ralquileres JOIN rvehiculos ON ralquileres.matricula = rvehiculos.matricula SET ralquileres.fecha_devolucion = NOW() ,ralquileres.preciototal = :pre ,rvehiculos.disponible = 'S', ralquileres.fechahorapago=NOW() WHERE ralquileres.matricula = :matr");
        $stmtFechaDev->bindParam(':pre',$precio);
        $stmtFechaDev->bindParam(':matr', $_SESSION['matricula']);
        $stmtFechaDev->execute();
        header('Location: ../views/movwelcome.php');
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
    }
?>


