<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    //header("Location: ../admin/index.php");
    if ($_SESSION['rol'] == 'admin') {
        //header("Location: ../admin/index.php");
    }
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../../public/css/globalStyle.css">
    <title>Perfil</title>
</head>

<body>
    <header>
        <?php
        include("../../../global/php/headerPublicUser.php");
        ?>
    </header>

    <div class="container">
        <header>
            <?php
            include("../../../global/php/headerUser.php");
            ?>
        </header>
        
        <section>
            <h2>Contactos</h2>                    
                <table >
                <tr>
                    <td><label>Asunto</label></td>
                    <td><input type="text" id="asu" name="asu" placeholder=""></td>
                </tr> 
                <tr>
                    <td><label>Mensaje</label></td>
                    <td><input type="text"  style="WIDTH: 228px; HEIGHT: 98px" size=32 name=mens placeholder="Escribir mensaje" ></td>
                </tr>
                <tr>
                <td colspan="3">
                        <div id="btn">
                            <input type="submit" id="crear" name="crear" value="Enviar">
                        </div>
                </td>
                </table>
        </section>
        
    </div>
    
    <footer>
        <script src="../js/funciones.js"></script>
        <?php
        include("../../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>