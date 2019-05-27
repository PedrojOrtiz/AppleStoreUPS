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
    <title>Historial</title>
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
            <h2>Historial de compras</h2>
            <div class="cardContent">
                <article>
                    <table>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Codigo</td>
                                <td>Metodo de pago</td>
                                <td>Total</td>
                                <td>
                                    <select id="selectStatus">
                                        <option value="pendiente">Pendiente</option>
                                        <option value="enviado">Enviador</option>
                                        <option value="cancelado">Cancelado</option>
                                    </select>
                                </td>
                                <td>Fecha</td>
                                <td></td>

                            </tr>
                        </thead>

                        <tfoot>
                            <tr>
                                <td colspan="10">
                                    <div class="links">
                                        <a href="#"><i class="fas fa-angle-left"></i></a>
                                        <a class="active" href="#">1</a>
                                        <a href="#">2</a>
                                        <a href="#">3</a>
                                        <a href="#">4</a>
                                        <a href="#"><i class="fas fa-chevron-right"></i></a>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>

                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>GBS5632</td>
                                <td>Tarjeta</td>
                                <td>$800.00</td>
                                <td><span>Pendiente</span></td>
                                <td>25/01/2019 10:15</td>
                                <td><a href="">Ver orden</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>GBS5632</td>
                                <td>Tarjeta</td>
                                <td>$800.00</td>
                                <td><span>Pendiente</span></td>
                                <td>25/01/2019 10:15</td>
                                <td><a href="">Ver orden</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>GBS5632</td>
                                <td>Tarjeta</td>
                                <td>$800.00</td>
                                <td><span>Pendiente</span></td>
                                <td>25/01/2019 10:15</td>
                                <td><a href="">Ver orden</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>GBS5632</td>
                                <td>Tarjeta</td>
                                <td>$800.00</td>
                                <td><span>Pendiente</span></td>
                                <td>25/01/2019 10:15</td>
                                <td><a href="">Ver orden</a></td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>GBS5632</td>
                                <td>Tarjeta</td>
                                <td>$800.00</td>
                                <td><span>Pendiente</span></td>
                                <td>25/01/2019 10:15</td>
                                <td><a href="">Ver orden</a></td>
                            </tr>
                        </tbody>
                    </table>
                </article>
            </div>
        </section>
    </div>

    <footer>
        <?php
        include("../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>