<?php
    session_start();
    setcookie(session_name(), '', time() - 3600, '/');
    session_abort();
    session_destroy();
    header('Location: ../views/movlogin.php');
?>