<?php 

    include '../../../config/configDB.php';

    session_start();

    if (isset($_SESSION['codigo']))
        $id=$_SESSION['codigo'];

    if($_SESSION["rol"] != "admin")
        header("Location: ../controller/logout.php");

    $sqlUsuario = "SELECT * FROM usuario user, imagen img WHERE user.usu_id = $id AND img.USUARIO_usu_id = $id";

    $resultUsuario = $conn->query($sqlUsuario);
    $rowUsuario = mysqli_fetch_assoc($resultUsuario);

    $nombres = $rowUsuario['usu_nombres'];
    $apellidos = $rowUsuario['usu_apellidos'];
    $img = $rowUsuario['img_nombre'];

    $sucId = $rowUsuario['SUCURSAL_suc_id'];

    $sqlSucursal = "SELECT * FROM sucursal suc WHERE suc.suc_id = $sucId";

    $resultSucursal = $conn->query($sqlSucursal);
    $rowSucursal = mysqli_fetch_assoc($resultSucursal);

    $sucId = $rowSucursal['suc_id'];
    $sucNombre = $rowSucursal['suc_nombre'];
    $sucTelefono = $rowSucursal['suc_telefono'];
    $sucCelular = $rowSucursal['suc_celular'];
    $sucUrl = $rowSucursal['suc_url'];
    $sucEliminado = $rowSucursal['suc_eliminado'];

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
    <link rel="stylesheet" href="../css/style2.css">
    <script type="text/javascript" src="../js/funciones.js"></script>
    <title>Productos</title>
</head>

<body>
    <header>
        <div class="content">        
            <div class="sessionItems">
                    <div class="header">
                        <ul class="nav">
                            <li> <a><?php echo strtoupper($nombres) ?> <?php echo strtoupper($apellidos) ?></a>
                                <ul>
                                    <li><a href="modify.php">Ajustes</a></li>
                                    <li><a href="../controller/logout.php">Cerrar Sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <div class="imgUser">
                    <img src="../../../img/user/<?php echo $id; ?>/<?php echo ($img); ?>" alt="">
                </div>
            </div>
        </div>
    </header>

    <div class="container">
        <header>
            <div class="perfil">
                <li><a>APPLE STORE EC</a></li>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
                    <li><a href="orders.php"><i class="fas fa-chart-bar"></i> Ordenes</a></li>
                    <li><a href="inbox.php"><i class="far fa-envelope"></i> Mensajes</a></li>
                    <li><a href="products.php"><i class="fa fa-barcode"></i> Productos</a></li>
                    <li><a href="clients.php"><i class="fas fa-users"></i> Clientes</a></li>
                    <li><a href="settings.php"><i class="fas fa-cog"></i> Configuracion</a></li>
                </ul>
            </nav>
        </header>
        <section>
            <h2>Productos</h2>
            <div class="cardContent">
                <h2>Sucursal: <?php echo strtoupper($sucNombre) ?></h2>
                <input type="text" class="content" id="nombre" name="nombre" value="" placeholder="Buscar..." onkeyup="return buscarPorNombre()"/> 
                <a href="../controller/crear_producto.php" class="center" id="button"> Crear Producto </a>
                <div class="formData">
                                
                <table id="productos"> 

                    <colgroup>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                        <col style='width: 5%'>
                    </colgroup>

                    <thead>
                        <tr>
                            <th>Creado</th>
                            <th>Modificado</th>
                            <th>Imagen</th>  
                            <th>Nombre</th>
                            <th>Precio</th> 
                            <th>Stock</th>
                            <th>Estado</th>
                            <th>Acciones</th>        
                        </tr>
                    </thead>

                    <tr>


<?php  

    

    $sqlPro =  "SELECT pro.pro_id, pro.pro_fecha_creacion, pro.pro_nombre, pro.pro_estado, pro.pro_precio, img.img_nombre, ps.pro_suc_stock, pro.pro_fecha_modificacion
                FROM producto pro, imagen img, producto_sucursal ps
                WHERE pro.pro_id = img.PRODUCTO_pro_id AND pro.pro_id = ps.PRODUCTO_pro_id AND ps.SUCURSAL_suc_id = $sucId
                GROUP BY img.PRODUCTO_pro_id
                ORDER BY pro.pro_fecha_creacion DESC";

    $resultPro = $conn->query($sqlPro);

    if ($resultPro->num_rows > 0) { 

        $resultPro = $conn->query($sqlPro);

        
        while($row = $resultPro->fetch_assoc()) {  
            


            echo "<tr>";   
                echo "<td>" . $row['pro_fecha_creacion'] . "</td>";

                if ($row['pro_fecha_modificacion'] == "") {
                    echo "<td>-</td>";
                } else {
                    echo "<td>" . $row['pro_fecha_modificacion'] . "</td>";
                }   
                echo "  <div class='cardImg'> 
                            <td> <img src='../../../img/product/".$row['pro_id']."/".$row['img_nombre']."' alt='".$row['img_nombre']."' height='80' width='80' > </td> 
                        </div> ";
                echo "<td>" . $row['pro_nombre'] ."</td>";
                echo "<td> $" . $row['pro_precio'] ."</td>";
                echo "<td>" . $row['pro_suc_stock'] ."u.</td>";
                if ($row['pro_estado'] == 0) {
                    echo "<td>Activo</td>";
                } else if ($row['pro_estado'] == 1) {
                    echo "<td>Inactivo</td>";
                }
                if ($row['pro_estado'] == 0) {
                echo "  <td> 
                            <a href='../controller/modificar_producto.php?id=".$row['pro_id']."' id='sbutton'> Modificar </a><br><br>";
                            
                echo       "<a href='../controller/eliminar_producto.php?id=".$row['pro_id']."' id='sbutton'> Eliminar </a>";  
                }
                                          
                echo       "</td>";                                            
            echo "</tr>";
        }

    } else { 

        echo "<tr>";                 
        echo "<td colspan='4'> No hay productos en esta sucursal </td>";                 
        echo "</tr>"; 

    }

    $conn->close();

?>

                </table>


                </div>
            </div>
        </section>
    </div>

    

</body>

</html>