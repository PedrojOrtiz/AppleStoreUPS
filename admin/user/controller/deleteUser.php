<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/view/index.php");
    }
} else {
    header("Location: ../../../index.php");
}
include '../../../config/configDB.php';
$pass = isset($_POST["deleteAccount"]) ? trim($_POST["deleteAccount"]) : null;
$date = date(date("Y-m-d H:i:s"));


$sql = "SELECT usu_password FROM usuario WHERE usu_id=" . $_SESSION['codigo'] . ";";
$result = $conn->query($sql);
$resultP = $result->fetch_assoc();
if (MD5($pass) == $resultP["usu_password"]) {
    $sql = "UPDATE usuario SET
            usu_eliminado=1,
            usu_fecha_modificacion='$date'
            WHERE usu_id=" . $_SESSION['codigo'] . ";";

    if ($conn->query($sql)) {
        header("Location: ../../../config/signout.php");
    } else {
        echo mysqli_error($conn);
    }
} else {
    //echo mysqli_error($conn);
    header("Location: ../view/settings.php");
}

$conn->close();