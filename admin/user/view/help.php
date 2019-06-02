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
    <title>Contactos</title>
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
            <h2>Contacto</h2>
            <div class="cardContent helpPage">
                <div class="formContact">
                    <form action="../controller/sendMessage.php" method="post">
                        <input type="text" name="asunto" id="asunto" placeholder="Asunto">
                        <textarea name="mensaje" id="mensaje" cols="30" rows="10" placeholder="Mensaje"></textarea>
                        <button type="submit"><i class="fas fa-paper-plane"></i> Enviar</button>
                    </form>
                </div>
                <div class="contactInfo">
                    <h2>Apple Store EC</h2>
                    
                    <p>Desde siempre, los productos Apple han sido diseñados pensando no sólo en cómo vivimos, sino también en cómo trabajamos.</p>
                    <p>Hoy estos productos ayudan a los empleados a trabajar de forma más simple y productiva, resolver problemas de forma creativa y colaborar para alcanzar un objetivo común.</p>
                    <p>Además, están pensados para trabajar juntos de una forma maravillosa. Cuando las personas tienen acceso a un iPhone, un iPad o una Mac, pueden dar lo mejor de sí y reinventar el futuro de sus empresas.</p>
                    <p><i class="fas fa-phone"></i> 0987654321</p>
                    <p><i class="fas fa-tty"></i> (07)3014329</p>
                    <p><i class="fas fa-at"></i> <a href="mailto:applestoreec@apple.com">applestoreec@apple.com</a></p>
                    <p><i class="fas fa-map-marker-alt"></i> Av.Juan Tamariz y 3 de Octubre, Cuenca, Ecuador</p>
                </div>
            </div>
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