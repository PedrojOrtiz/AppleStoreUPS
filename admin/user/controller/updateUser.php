<?php
include '../../../config/configDB.php';

$foto = $_FILES['foto']['name'];
$temp = $_FILES['foto']['tmp_name'];

move_uploaded_file($temp, "../../../img/user/" . $_POST["codigo"] . "/$foto");


$codigo = isset($_POST["codigo"]) ? trim($_POST["codigo"]) : null;
$nombre = isset($_POST["nombre"]) ? mb_strtoupper(trim($_POST["nombre"]), 'UTF-8') : null;
$apellido = isset($_POST["apellido"]) ? mb_strtoupper(trim($_POST["apellido"]), 'UTF-8') : null;
$cedula = isset($_POST["cedula"]) ? trim($_POST["cedula"]) : null;
$telefono = isset($_POST["telefono"]) ? trim($_POST["telefono"]) : null;
$fecha = $_POST["fechaNacimiento"];
$email = isset($_POST["email"]) ? trim($_POST["email"]) : null;
$dirNombre = isset($_POST["derecNombre"]) ? trim($_POST["derecNombre"]) : null;
$dirCP = isset($_POST["direcCalle1"]) ? mb_strtoupper(trim($_POST["direcCalle1"]), 'UTF-8') : null;
$dirCS = isset($_POST["direcCalle2"]) ? mb_strtoupper(trim($_POST["direcCalle2"]), 'UTF-8') : null;
$ciudad = isset($_POST["ciudad"]) ? mb_strtoupper(trim($_POST["ciudad"]), 'UTF-8') : null;
$provincia = isset($_POST["provincia"]) ? mb_strtoupper(trim($_POST["provincia"]), 'UTF-8') : null;
$codPost = isset($_POST["codPost"]) ? trim($_POST["codPost"]) : null;
$date = date(date("Y-m-d H:i:s"));

echo ($telefono);
echo ($fecha);

$sql = "UPDATE usuario SET
            usu_cedula='$cedula ',
            usu_nombres='$nombre',
            usu_apellidos='$apellido',
            usu_telefono='$telefono',
            usu_fecha_nacimiento='$fecha',
            usu_correo='$email',
            usu_fecha_modificacion='$date'
            WHERE usu_id='$codigo';";

$sqlImg = "UPDATE imagen SET
img_nombre ='$foto'
WHERE USUARIO_usu_id='$codigo';";

$sqlDireccion = "SELECT *  FROM usuario, direccion WHERE
                    usuario.usu_id=direccion.USUARIO_usu_id AND
                    usu_id='$codigo';";
$result = $conn->query($sqlDireccion);
if ($result->num_rows > 0) {
    $sqlDir = "UPDATE direccion SET
    dir_nombre='$dirNombre',
    dir_calle_principal='$dirCP',
    dir_calle_secundaria='$dirCS',
    dir_diudad='$ciudad',
    dir_provincia='$provincia',
    dir_codigo_postal ='$codPost'
    WHERE USUARIO_usu_id='$codigo';";

    echo 'si hay datos';
} else {
    $sqlDir = "INSERT INTO direccion (
    dir_nombre, 
    dir_calle_principal, 
    dir_calle_secundaria, 
    dir_ciudad, 
    dir_provincia, 
    dir_codigo_postal,
    USUARIO_usu_id) VALUES (
        '$dirNombre', 
        '$dirCP', 
        '$dirCS', 
        '$ciudad', 
        '$provincia',
        '$codPost',
        '$codigo');";
    //echo 'No hay datos';
}


if ($conn->query($sql) == true && $conn->query($sqlImg) == true && $conn->query($sqlDir) == true) {
    //header("Location: ../view/index.php?update=true");
} else {
    if ($conn->errno == 1062) {
        //header("Location: ../view/index.php?update=false&error=1062");
    } else {
        //header("Location: ../view/index.php?update=false&error=" . mysqli_error($conn));
    }
}
$conn->close();