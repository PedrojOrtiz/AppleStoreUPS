<?php
session_start();
unset($_SESSION['isLogged']);
unset($_SESSION['id']);
unset($_SESSION['rol']);
unset($_SESSION['img']);
unset($_SESSION['nombre']);
unset($_SESSION['apellido']);
unset($_SESSION);
session_destroy();

session_destroy();
if (isset($_SESSION['isLogin']) and $_SESSION['isLogin'] == true) {
    $_SESSION['isLogin'] = false;
    session_destroy();
}
header("Location: ../index.php");