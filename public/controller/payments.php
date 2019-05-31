<?php
include '../../config/configDB.php';

$cardNumber = isset($_POST["numbreCard"]) ? trim($_POST["numbreCard"]) : null;
$apellido = isset($_POST["apellido"]) ? mb_strtolower(trim($_POST["apellido"]), 'UTF-8') : null;
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$pass = isset($_POST["pass"]) ? $_POST["pass"] : null;

$sql = "INSERT INTO usuario (
    usu_nombres, 
    usu_apellidos,  
    usu_correo, 
    usu_password) VALUES (  
    '$nombre', 
    '$apellido', 
    '$email', 
    MD5('$pass')
);";

$sqlImg = "INSERT INTO imagen (
    img_nombre, 
    USUARIO_usu_id) VALUES (
    '$foto',
    '$codigoNewUser'
);";

if ($conn->query($sql) == true && $conn->query($sqlImg) == true) {
    header("Location: ../view/successful.php?register=true");
} else {
    if ($conn->errno == 1062) {
        header("Location: ../view/successful.php?register=false&error=1062");
    } else {
        echo mysqli_error($conn);
        header("Location: ../view/successful.php?register=false&error=" . mysqli_error($conn));
    }
}

$conn->close();