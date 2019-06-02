<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    }
}
include '../../config/configDB.php';
$sql = "SELECT SUM(car_cantidad) AS car_cantidad FROM carrito WHERE 
    USUARIO_usu_id=" . $_SESSION['codigo'] . ";";
$result = $conn->query($sql);
if ($result->num_rows != 0) {
    $res = $result->fetch_assoc();
    echo '<span>' . $res['car_cantidad'] . '</span>';
}