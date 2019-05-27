<?php
//unset($_GET['login']);

if (isset($_GET['register'])) {
    if ($_GET['register'] == 'true') {
        //exito
        echo 'Registro exitoso inicie session y edite su informacion';
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
        echo 'Logeo exitoso';
        // if ($_SESSION['rol'] == 'admin') {
        //     //header("Refresh:2; url=../../admin/vista/admin/index.php");
        // } else {
        //     //header("Refresh:2; url=../../admin/vista/usuario/index.php");
        // }
    } else {
        //fracaso
        echo 'Logeo incorrecto';
    }
}