<?php
session_start();
include '../../config/configDB.php';
$sql = "SELECT SUM(car_cantidad) AS car_cantidad FROM carrito WHERE 
    USUARIO_usu_id=" . $_SESSION['codigo'] . ";";
$result = $conn->query($sql);
if ($result->num_rows != 0) {
    $res = $result->fetch_assoc();
    echo '<span>' . $res['car_cantidad'] . '</span>';
}