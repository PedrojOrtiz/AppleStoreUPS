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
        <h1>Datos Personales</h1>
        <form method="POST" action="../javascript/validaciones.php" onsubmit="return validarCamposObligatorios()">
            <table>
                <tr>
                    <td><label>Cedula</label></td>
                    <td><input type="text" id="ced" name="ced" placeholder="ingresar cédula" onfocus="wErrores(this)"
                        onkeyup="this.value = val_numero(this.value)"
                        onchange="this.value = validarCedula(this.value)"></td>
                    <td>
                        <span id="mensajeCedula"></span>
                    </td>
                </tr> 

                <tr>
                    <td><label>Nombre</label></td>
                    <td><input type="text" name="nom" placeholder="ingresar nombres" onfocus="wErrores(this)"
                            onkeyup="this.value = validarLetras(this.value)"
                            onchange="this.value = dosPalabras(this.value)"></td>
                </tr>

                <tr>
                    <td><label>Apellido</label></td>
                    <td><input type="text" name="ape" placeholder="ingresar apellidos" onfocus="wErrores(this)"
                            onkeyup="this.value = validarLetras(this.value)"
                            onchange="this.value = dosPalabras(this.value)"></td>
                </tr>

                <tr>
                    <td><label>Dirección</label></td>
                    <td><input type="text" name="dir" placeholder="ingresar dirección" onfocus="wErrores(this)">
                    </td>
                </tr>

                <tr>
                    <td><label>Teléfono</label></td>
                    <td><input type="text" name="tel" placeholder="ingresar telefóno" onfocus="wErrores(this)"
                            onkeyup="this.value = validarNumero(this.value)"></td>
                </tr>

                <tr>
                    <td><label>Fecha de Nacimiento</label></td>
                    <td><input type="text" id="fec" name="fec" placeholder="dd/mm/yyyy" onfocus="wErrores(this)">
                    </td>
                    <td>
                        <spam id="f" style="display: none;">ERROR</spam>
                    </td>
                </tr>

                <tr>
                    <td><label>Email</label></td>
                    <td><input type="text" id="ema" name="ema" placeholder="ingresar email" onfocus="wErrores(this)">
                    </td>
                    <td>
                        <spam id="e" style="display: none;">ERROR</spam>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div id="btn">
                            <input type="submit" id="crear" name="crear" value="Aceptar">
                            <input type="reset" id="cancelar" name="cancelar" value="Cancelar">
                        </div>
                    </td>
                </tr>
            </table>
        </form>
        <spam id="p" style="display: none;">Error, campos incompletos!</spam>
    </div>
    </section>

</body>

</html>