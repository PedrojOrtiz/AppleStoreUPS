<?php
session_start();
if (!isset($_SESSION['isLogin'])) {
    header("Location: ../../../public/view/index.php");
} elseif ($_SESSION['rol'] == 'admin') {
    header("Location: ../view/clients.php");
}

include '../../../config/configDB.php';

$idUs = $_REQUEST['id'];
    $sqlUs = "UPDATE usuario SET usu_eliminado = 1 WHERE usu_id = $idUs";

    if ($conn->query($sqlUs) === TRUE) {             
        echo "Eliminado logico Correcto";      
    } else {             
        echo "Error al eliminar";
        echo "<p class='error'>Error: " . mysqli_error($conn) . "</p>";           
    }

    $conn->close();
?>
