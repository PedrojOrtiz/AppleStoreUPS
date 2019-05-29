<?php
//unset($_GET['login']);
session_start();
if (!isset($_SESSION['isLogin'])) {
    header("Location: index.php");
}
// elseif ($_SESSION['rol'] == 'user') {
//     header("Location: ../usuario/index.php");
// }

if (isset($_GET['register'])) {
    if ($_GET['register'] == 'true') {
        //exito
        echo 'Registro exitoso inicie session y edite su informacion <br>';
        echo '<a href="login.php">login</a>';
    } else {
        //fracaso
        if (isset($_GET['error'])) {
            //fracaso
            if ($_GET['error'] == '1062') {
                //error de usuario duplicado
                echo 'usuario duplicaco';
            } else {
                //error insesperado
                echo ($_GET['error']);
            }
        }
    }
} elseif (isset($_GET['login'])) {
    if ($_GET['login'] === 'true') {
        //exito
        echo 'Logeo exitoso<br>';

        if ($_SESSION['rol'] == 'user') {
            echo 'Ir al inicio<br>';
            echo '<a href="index.php">Inicio</a>';
            //header("Refresh:2; url=../../admin/vista/admin/index.php");
        } else {
            echo 'Ir a la administracion<br>';
            echo '<a href="../../admin/admin/view/index.php">Inicio</a>';
            //     //header("Refresh:2; url=../../admin/vista/usuario/index.php");
        }
    } else {
        //fracaso
        echo 'Logeo incorrecto';
    }
}