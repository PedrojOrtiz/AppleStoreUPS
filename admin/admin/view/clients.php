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
    <title>Perfil</title>
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
            <h2>Clientes</h2>
           
            <div class="cardContent">
                <table>
                <tr>
               <th>Nombres</th>
               <th>Apellidos</th>
               <th>Correo</th>
               <th>Fecha de Modificacion</th>
               <th colspan="3">Administrar</th>
                </tr>

           <?php

               $sql = "SELECT * FROM usuario WHERE usu_rol LIKE 'user'";
               $result = $conn->query($sql);

               if ($result->num_rows > 0){
                   while($row = $result->fetch_assoc()){
                       if($row["usu_eliminado"]!=1){
                           echo "<tr>";
                           echo "<td>" .$row["usu_nombres"]."</td>";
                           echo "<td>" .$row["usu_apellidos"]."</td>";
                           echo "<td>" .$row["usu_correo"]."</td>";
                           echo "<td>" .$row["usu_fecha_modificacion"]."</td>";
                           if ($row['usu_eliminado'] == 0) {                             
                            echo "<td> <a href='../controller/eliminar.php?id=$row[usu_id]'> Eliminar </a>  </td> ";                                                                  
                            } else {
                            echo "<td>  </td> ";
                            }
                           echo "<td class='accion'><a href='modificar.php?codigo=".$row['usu_id']."&id=".$id."'>Modificar</a></td>";
                           echo "<td class='accion'><a href='cambiar_contrasena.php?codigo=".$row['usu_id']."&id=".$id."'>Cambiar contrasena</a></td>";
                       }
                   }
               }else{
                   echo "<tr>";
                   echo "<td colspan='7'>No existen usuarios registrados en el sistema</td>";
                   echo "</tr>";
               }
               $conn->close();
           ?>
       </table>
            </div>
        </section>
    </div>

    

</body>

</html>