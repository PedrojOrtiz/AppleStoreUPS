<?php
session_start();
include '../../config/configDB.php';
if (isset($_SESSION['codigo'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
    } else {
        $sqlRatP = "SELECT rat.rat_calificacion
            FROM producto pro, rating rat, usuario usu
            WHERE pro.pro_id = rat.PRODUCTO_pro_id AND
            usu.usu_id = rat.USUARIO_usu_id AND
            pro.pro_estado=0 AND
            usu.usu_id=" . $_SESSION['codigo'] . " AND
            pro.pro_id=" . $_GET['prodID'] . ";";
        $resultRatP = $conn->query($sqlRatP);
        $resultCal = $resultRatP->fetch_assoc();
        if ($resultRatP->num_rows > 0) {
            echo 'Ya se a calificado con ' . $resultCal['rat_calificacion'];
        } else {
            $sql = "INSERT INTO rating (
        rat_calificacion, 
        rat_descripcion, 
        USUARIO_usu_id,
        PRODUCTO_pro_id) VALUE (
            " . $_GET['rat'] . ",
            'Calificacion',
            " . $_SESSION['codigo'] . ",
            " . $_GET['prodID'] . "
        );";
            if ($conn->query($sql)) {
                echo  $_GET['rat'];
            } else {
                echo 'Error al calificar';
            }
        }
    }
} else {
    header("Location: ../login.php");
}