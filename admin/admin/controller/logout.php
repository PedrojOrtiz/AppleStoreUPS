<?php
    session_start(); 
    unset($_SESSION['isLogged']);
    unset($_SESSION['id']);
    unset($_SESSION['rol']);
    unset($_SESSION['img']);
    unset($_SESSION);
    session_destroy();
    header("Location: ../../../public/view/index.php");
?>