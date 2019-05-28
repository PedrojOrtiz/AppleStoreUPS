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

    <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script> -->

    <title>Factura</title>
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
            <h2>Factura</h2>
            <div class="cardContent invoice">
                <div class="invoiceHeader">
                    <div class="invoiceDetail">
                        <h2>Apple Store EC</h2>
                        <p>Cuenca, Azuay</p>
                        <p>Tel. 0978781341</p>
                    </div>
                    <div class="invoicePrint">
                        <h2>Factura</h2>
                        <button><i class="fas fa-print"></i> Imprimir</button>
                    </div>
                </div>
                <div class="invoiceBody">
                    <div class="ivoiceBodyDetall">
                        <div class="invoiceDetailTo">
                            <h3>Factura a:</h3>
                            <p>Richard Torres</p>
                            <p>Cl. 0106464456</p>
                            <p>Dir. Av. Jaime Roldos y 3 de Noviembre</p>
                            <p>Tel. 0992631254</p>
                        </div>
                        <div class="invoiceDetailStatus">
                            <p><span>Fecha: </span>25/01/2019</p>
                            <p><span>Status: </span><span class="status">Pendiente</span></p>
                            <p><span>Codigo de orden: </span>GBS5632</p>
                        </div>
                    </div>

                    <article>
                        <table>
                            <thead>
                                <tr>
                                    <td>#</td>
                                    <td>Producto</td>
                                    <td>Descripcion</td>
                                    <td>Tienda</td>
                                    <td>Precio</td>
                                    <td>Rutas</td>
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

                            <div id="floatWindow">
                                <input id="start" type="hidden" name="" value="gualaceo">
                                <input id="end" type="hidden" name="" value="Calle Vieja, Cuenca 010105">

                                <div class="contentMap">
                                    <i class="fas fa-times" onclick="cluseWindow()"></i>
                                    <div id="map"></div>
                                </div>
                            </div>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><a href="">
                                            <img src="../../../img/product/producto.jpg" alt="">
                                            <p>Lorem</p>
                                        </a>
                                    </td>
                                    <td>Este es el de la prueba de mapa.</td>
                                    <td><a href="">Guayaquil</a></td>
                                    <td>$700.00</td>
                                    <td><a onclick="openWindow()">Ver ruta</a>
                                    </td>

                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><a href="">
                                            <img src="../../../img/product/product2.png" alt="">
                                            <p>Lorem</p>
                                        </a>
                                    </td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ex voluptatem harum
                                        reiciendis sunt quam animi praesentium impedit pariatur, debitis quaerat velit
                                        odit facere quos est maxime aspernatur vitae voluptatibus quas consequuntur cum
                                        repellendus assumenda blanditiis temporibus? Eveniet id odio, facere culpa
                                        fugiat placeat numquam tempora molestiae provident ipsum similique! Vel.</td>
                                    <td><a href="">Guayaquil</a></td>
                                    <td>$700.00</td>
                                    <td><a namer onclick="openWindow()">Ver ruta</a></td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><a href="">
                                            <img src="../../../img/product/producto.jpg" alt="">
                                            <p>Lorem</p>
                                        </a>
                                    </td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                    <td><a href="">Guayaquil</a></td>
                                    <td>$700.00</td>
                                    <!-- <td><a href="">Ver ruta</a></td> -->
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><a href="">
                                            <img src="../../../img/product/producto.jpg" alt="">
                                            <p>Lorem</p>
                                        </a>
                                    </td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                    <td><a href="">Guayaquil</a></td>
                                    <td>$700.00</td>
                                    <!-- <td><a href="">Ver ruta</a></td> -->
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td><a href="">
                                            <img src="../../../img/product/producto.jpg" alt="">
                                            <p>Lorem</p>
                                        </a>
                                    </td>
                                    <td>Lorem ipsum dolor sit amet consectetur adipisicing elit.</td>
                                    <td><a href="">Guayaquil</a></td>
                                    <td>$700.00</td>
                                    <!-- <td><a href="">Ver ruta</a></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </article>
                    <div class="invoiceFooter">
                        <p><span>Sub-total: </span> $2930.00</p>
                        <h2>USD 4930.00</h2>
                        <button id="cancelar">Cancelar</button>
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
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWSPPYtqD1tZgvQ-pPzLRXttQoVCOM9Jc&callback&callback=initMap">
    </script>
    <script src="../js/map.js"></script>

</body>

</html>