<?php
	session_start();
	// Se incluye la librería
	include 'apiRedsys.php';
	$precio=strval($_SESSION['precio']*100);
	// Se crea Objeto
	$miObj = new RedsysAPI;
	// Valores de entrada que no hemos cmbiado para ningun ejemplo
	$fuc="999008881";
	$terminal="1";
	$moneda="978";
	$trans="0";
	$urlOK="http://localhost/movilmad/models/hacerDevolucion.php";
	$urlKO="../controllers/pasarelaKO.php";
	$id=time();
	$amount=$precio;	
	echo $amount;
	//$_SESSION['precio']
	// Se Rellenan los campos
	$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
	$miObj->setParameter("DS_MERCHANT_ORDER",$id);
	$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
	$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
	$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
	$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
	$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$urlOK);
	$miObj->setParameter("DS_MERCHANT_URLOK",$urlOK);
	$miObj->setParameter("DS_MERCHANT_URLKO",$urlKO);

	//Datos de configuración
	$version="HMAC_SHA256_V1";
	$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
	// Se generan los parámetros de la petición
	$request = "";
	$params = $miObj->createMerchantParameters();
	$signature = $miObj->createMerchantSignature($kc);

?>
<html lang="es">
<head>
</head>
<body>
<form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
<input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>" hidden/></br>
<input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>" hidden/></br>
<input type="text" name="Ds_Signature" value="<?php echo $signature; ?>" hidden/></br>
<input type="submit" value="¿Confirmas la Compra?" >
</form>

</body>
</html>
