<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    header("Location: ../../index.php");
}
include '../../config/configDB.php';
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$pass = isset($_POST["pass"]) ? trim($_POST["pass"]) : null;
$sql = "SELECT * FROM usuario user, imagen img WHERE user.usu_id = img.USUARIO_usu_id AND user.usu_correo ='$email' AND user.usu_password = MD5('$pass')";

$result = $conn->query($sql);
$result2 = $conn->query($sql);
$rowUsuario= mysqli_fetch_assoc($result2);

$id = $rowUsuario['usu_id'];
$eliminado = $rowUsuario['usu_eliminado'];
$rol = $rowUsuario['usu_rol'];
$img = $rowUsuario['img_nombre'];
$nombres = $rowUsuario["usu_nombres"];
$apellidos = $rowUsuario["usu_apellidos"];
$correo = $rowUsuario["usu_correo"];

if ($eliminado == '1') {
    
    echo "<p>Has sido eliminado por los administradores</p>";

} else {

    if ($result->num_rows > 0 && $rol == "admin") {  
        session_start();
        $_SESSION['codigo']= $id;          
        $_SESSION['isLogin'] = true;
        $_SESSION["rol"] = "admin";
        $_SESSION['img'] = $img;  
        $_SESSION['nombre'] = $nombres;
        $_SESSION['apellido'] = $apellidos;
        header("Location: ../../admin/admin/view/index.php"); 
    } else if ($result->num_rows > 0 && $rol == "user") {
        session_start();
        $_SESSION['codigo']= $id;             
        $_SESSION['isLogin'] = true;
        $_SESSION["rol"] = "user";
        $_SESSION['img'] = $img; 
        $_SESSION['nombre'] = $nombres;
        $_SESSION['apellido'] = $apellidos;
        header("Location: ../view/successful.php?login=true");
    } else { 
        //header("Location: ../view/successful.php?login=false");
        echo $rol;
        echo "correo o contraseña incorrecta";
    } 

}


/*if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    
    $_SESSION['codigo'] = $user["usu_id"];
    $_SESSION['nombre'] = $user["usu_nombres"];
    $_SESSION['apellido'] = $user["usu_apellidos"];
    $_SESSION['correo'] = $user["usu_correo"];
    $_SESSION['img'] = $user["img_nombre"];
    $_SESSION['rol'] = $user["usu_rol"];

    header("Location: ../view/successful.php?login=true");
} else {

    header("Location: ../view/successful.php?login=false");
} */

$conn->close();

?>