
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
    <?php 
    if($_SERVER["REQUEST_METHOD"]=="POST"){

        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "comprasweb";
        try{
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $usu=$_POST['username'];
            $pss=$_POST['password'];
            $stmt=$conn->prepare("SELECT usuario, contrasena FROM cliente");
            $stmt->execute();
            $array=$stmt->fetchAll(PDO::FETCH_ASSOC);
            $x=false;
            foreach ($array as $key) {
                if($key['usuario']==$usu && $key['contrasena']==$pss){
                    $x=true;
                }
            }
            if($x==true){
                session_start();
                $_SESSION['usu']=$usu;
                header('Location: comprar.php');
                
            }else{
                echo "<p id='mensE'>Usuario no encontrado</p>";
            }


        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
        }
    }
    
    ?>
</body>
</html>
