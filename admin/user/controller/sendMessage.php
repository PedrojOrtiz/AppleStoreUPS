<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/view/index.php");
    }
} else {
    header("Location: ../../../index.php");
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../../../public/css/generalStyle.css">
    <link rel="stylesheet" href="../../../public/css/globalStyle.css">
    <title>Successful4</title>
</head>

<body>
    <header>
        <?php
        //echo (getcwd());
        include("../../../global/php/headerPublicUser.php");
        ?>
    </header>

    <div class="headerImg pageError pageSuccess">
        <?php
        include '../../../config/configDB.php';
        $asunto = isset($_POST["asunto"]) ? mb_strtolower(trim($_POST["asunto"]), 'UTF-8') : null;
        $mensaje = isset($_POST["mensaje"]) ? mb_strtolower(trim($_POST["mensaje"]), 'UTF-8') : null;
        $date = date(date("Y-m-d H:i:s"));
        $sql = "INSERT INTO hoja_contacto (
            con_asunto, 
            con_contenido,  
            con_fecha, 
            USUARIO_usu_id) VALUES (  
            '$asunto', 
            '$mensaje', 
            '$date', 
            " . $_SESSION['codigo'] . ");";
        if ($conn->query($sql)) {
            ?>
        <div class="contentSucce">
            <h2>Mensaje enviado con exito.</h2>
            <p>En breve los administradores se pondran en contacto con usted.</p>
            <i class="far fa-check-circle"></i>
            <button onclick="window.location.href = '../view/help.php'">Regresar</button>
        </div>
        <?php
    } else {
        ?>
        <div class="contentSucce">
            <h2>Error insesperado al enviar el mensaje</h2>
            <p><?php echo $_GET['error'] ?></p>
            <p>Error al registrar..</p>
            <i class="far fa-times-circle"></i>
            <button onclick="window.location.href = '../view/help.php'">Regresar</button>
        </div>
        <?php
    }
    ?>

    </div>
    <footer>
        <?php
        //echo (getcwd());
        include("../../../global/php/footerPublicUser.php");
        ?>
    </footer>

</body>

</html>
</body>

</html>