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
<html>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../css/globalStyle.css">
    <link rel="stylesheet" href="../css/generalStyle.css">
    <title>Contactos</title>
</head>

<body>
    <header>
        <?php
        include("../../global/php/headerPublic.php");
        ?>
    </header>
    <section>
    <div id="form">
        <h1>Contactos</h1>
            <table>
                <tr>
                    <td><label>Asunto</label></td>
                    <td><input type="text" id="asu" name="asu" placeholder=""></td>
                </tr> 

                <tr>
                    <td><label>Mensaje</label></td>
                    <td><input type="text" name="men" placeholder="Escribir mensaje" ></td>
                </tr>

                <tr>
                    <td colspan="1">
                        <div id="btn">
                            <input type="submit" id="crear" name="crear" value="Aceptar">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    </section>

</body>

</html>