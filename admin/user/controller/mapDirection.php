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
if (isset($_GET['storeId'])) { }
$sqlDirUser = "SELECT * FROM usuario usu, direccion dir 
                WHERE dir.USUARIO_usu_id=usu.usu_id AND 
                usu.usu_id=" . $_SESSION['codigo'] . ";";

$sqlDirUser = $conn->query($sqlDirUser);
$sqlDirUser = $sqlDirUser->fetch_assoc();
$dirStart = $sqlDirUser['dir_nombre'] . ', ' . $sqlDirUser['dir_calle_principal'] . ', ' . $sqlDirUser['dir_calle_secundaria'] . ', ' . $sqlDirUser['dir_ciudad'];

$sqlDirSuc = "SELECT * FROM sucursal suc, direccion_sucursal ds, direccion dir 
                WHERE ds.SUCURSAL_suc_id=suc.suc_id AND
                        ds.DIRECCION_dir_id=dir.dir_id AND
                        suc.suc_id=" . $_GET['storeId'] . ";";

$sqlDirSuc = $conn->query($sqlDirSuc);
$sqlDirSuc = $sqlDirSuc->fetch_assoc();
$dirEnd = $sqlDirSuc['dir_nombre'] . ', ' . $sqlDirSuc['dir_calle_principal'] . ', ' . $sqlDirSuc['dir_calle_secundaria'] . ', ' . $sqlDirSuc['dir_ciudad'];

echo '<input id="start" type="hidden" name="" value="' . $dirStart . '">';
echo '<input id="end" type="hidden" name="" value="' . $dirEnd . '">';