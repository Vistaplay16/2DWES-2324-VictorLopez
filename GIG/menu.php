<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleMenu.css">
</head>
<body>
    <div class="navbar">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
            <input type="submit" value="Cerrar Sesion" id="cerrarSes">
        </form>
        <h1 id="titulo">Menu</h1>
        <ul>
            <li><a href="comaltaalm.php"><button>Alta Almacén</button></a></li>
            <li><a href="comaltacat.php"><button>Alta Categoría</button></a></li>
            <li><a href="comaltacli.php"><button>Alta Cliente</button></a></li>
            <li><a href="comaltapro.php"><button>Alta Producto</button></a></li>
            <li><a href="comaprpro.php"><button>Aprobar Producto</button></a></li>
            <li><a href="comconsalm.php"><button>Consulta Almacén</button></a></li>
            <li><a href="comconscom.php"><button>Consulta Compras</button></a></li>
            <li><a href="comconstock.php"><button>Consulta Stock</button></a></li>
            <li><a href="comlog.php"><button>Log</button></a></li>
            <li><a href="compro.php"><button>Proceso</button></a></li>
            <li><a href="comregcli.php"><button>Registro Cliente</button></a></li>
        </ul>
    </div>

    <?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        cerrarSesion();
    }
    if (isset($_SESSION['usu']) && $_SESSION['usu'] === true) {
        echo "<p>Bienvenido     ". $_SESSION['usu']."</p>";
    }else {
        header("Location: comlog.php");
        exit();
    }
    
    function cerrarSesion(){
        session_start();
        $_SESSION = array();
        setcookie(session_name(),'', time() - 3600, '/');
        header("Location: comlog.php");
    }
    ?>

</body>
</html>