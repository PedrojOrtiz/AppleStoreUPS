<?php
include '../../config/configDB.php';
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : null;
$sql = "SELECT * FROM usuario user, imagen img WHERE user.usu_id = img.USUARIO_usu_id and user.usu_correo ='$email' AND user.usu_password = MD5('$pass')";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    session_start();
    $_SESSION['isLogin'] = true;
    $_SESSION['codigo'] = $user["usu_id"];
    $_SESSION['nombre'] = $user["usu_nombres"];
    $_SESSION['apellido'] = $user["usu_apellidos"];
    $_SESSION['correo'] = $user["usu_correo"];
    $_SESSION['img'] = $user["img_nombre"];
    $_SESSION['rol'] = $user["usu_rol"];

    header("Location: ../view/successful.php?login=true");
} else {
    header("Location: ../view/successful.php?login=false");
}
$conn->close();