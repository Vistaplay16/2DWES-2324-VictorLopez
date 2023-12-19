<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    function datosServer($dbname){
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $arrayReturn=array($servername,$dbname, $username, $password );
        return $arrayReturn;
    }
    
    
    ?>
</body>
</html>