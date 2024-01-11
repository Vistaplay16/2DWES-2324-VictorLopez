<?php	
function crearCookie($nom, $val){
setcookie($nom, $val,  time() + 3600, '/');

}

?>