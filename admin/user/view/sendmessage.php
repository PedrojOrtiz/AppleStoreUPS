<!-- <!DOCTYPE html>
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
    <title>Enviar mensaje</title>
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
            <h2>Mensajes</h2>
            <div class="cardContent">
                <div class="btnsOptions">
                    <button>Mostrar todo</button>
                    <button>Mensajes enviados</button>
                    <button>Mensajes recibidos</button>
                    <button>Nuevo mensaje</button>
                </div>
                <div class="settings sendMessage">
                    <div class="formData">
                        <form method="">
                            <label for="destino">Destino:</label>
                            <input type="email" name="destino" id="destino" required>
                            <label for="asunto">Aesunto:</label>
                            <input type="text" name="asunto" id="asunto">
                            <label for="contenido">Mensaje:</label>
                            <textarea name="contenido" id="contenido" cols="40" rows="10"></textarea>

                            <div class="messageReply">
                                <button>Enviar</button>
                                <button>Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>

    <footer>
        <?php
        include("../../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html> -->