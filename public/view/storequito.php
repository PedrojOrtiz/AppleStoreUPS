<?php
session_start();
if (isset($_SESSION['isLogin'])) {
    if ($_SESSION['rol'] == 'admin') {
        header("Location: ../../admin/admin/view/index.php");
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
    <link rel="stylesheet" href="../css/globalStyle.css">

    <title>Tienda Quito</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>

    <section>
        <div class="headerImg storeImg storeGuayaqil storeQuito">
            <div class="bg">
                <h1>Apple store quito</h1>
            </div>
        </div>

        <div class="content storeInf">
            <div class="storeDescription">
                <div class="storeAbout">
                    <h3>Acerca de nosostros</h3>
                    <p>Somos una empresa de éxito nacional y tecnología innovadora, cuya sede está ubicada en la ciudad
                        de Cuenca.
                        Nuestros productos y servicios nos han convertido en líder tecnológico en el mercado y en un
                        socio fiable del sector de distribución de tecnología.
                        Nuestra experiencia de más de 85 años en la venta de productos totalmente originales de Apple
                        nos a llevado a una gran reputación a lo largo de este tiempo ya que nuestros productos son de
                        alta calidad y excelente garantía a nivel nacional.
                    </p>
                </div>
                <div class="storeContact">
                    <h3>Horarios de atencion</h3>
                    <p>Lunes a Viernes de 8:00 a 16:00</p>
                    <p><i class="fas fa-phone"></i> 0982563215</p>
                    <p><i class="fas fa-tty"></i> (07)23125</p>
                    <p><i class="fas fa-at"></i> <a
                            href="mailto:aplestoreguayaquil@aple.com">applestorequito@apple.com.ec</a></p>
                    <p><i class="fas fa-map-marker-alt"></i> Av.Amazonas N32-152 y Naciones unidas</p>
                </div>
            </div>
            <div class="storeMap">
                <div id="map"></div>
            </div>
        </div>
    </section>

    <!-- <script src="../js/map.js"></script>
    <script>
        navigator.geolocation.getCurrentPosition(fn_ok, fn_mal);
        function fn_mal() { }

        function fn_ok(rta) {

            lat = rta.coords.latitude;
            long = rta.coords.longitude;

            //loadMap(lat, long, -2.91900, -79.01455)
            loadMap(lat, long, -0.17753, -78.48483, 10, 'Quito', 'Centro Comercial Iñaquito (CCI)')
        }
    </script> -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCWSPPYtqD1tZgvQ-pPzLRXttQoVCOM9Jc&callback"></script>
    <script src="../js/map.js" onload="initMap(-0.17753, -78.48483, 18)"></script>

    <footer>
        <?php
        include("../../global/php/footerPublic.php");
        ?>
    </footer>

</body>

</html>
</body>

</html>