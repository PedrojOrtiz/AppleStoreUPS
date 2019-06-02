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
$sql = "UPDATE factura_cabecera SET
            fac_cab_eliminado=1
            WHERE fac_cab_id=" . $_GET['fac_cab_id'] . ";";
$conn->query($sql);
header("Location: ../view/shoppinghistory.php");