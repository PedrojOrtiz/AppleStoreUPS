<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    } else {
        header("Location: ../../index.php");
    }
}
include '../../config/configDB.php';

$foto = $_FILES['foto']['name'];
$temp = $_FILES['foto']['tmp_name'];
$type = $_FILES['foto']['type'];

$sql = "SELECT MAX(usu_id) AS codigo  FROM usuario;";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$codigoNewUser = ($row['codigo'] + 1);
echo $codigoNewUser;

$directorio = "../../img/user/" . $codigoNewUser . "/";
mkdir($directorio, 0777, true);

move_uploaded_file($temp, "../../img/user/" . $codigoNewUser . "/$foto");

$nombre = isset($_POST["nombre"]) ? mb_strtolower(trim($_POST["nombre"]), 'UTF-8') : null;
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