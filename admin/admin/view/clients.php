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
    <title>Perfil</title>
</head>

<body>
    <?php
        include '../../../config/configDB.php';
        $codigo_admin = $_GET["codigo_admin"];
    ?>
    <header>
        <div class="content">        
            <div class="sessionItems">
                    <div class="header">
                        <ul class="nav">
                            <li> <a>Nombre Apellido</a>
                                <ul>
                                    <li><a href="modify.php">Ajustes</a></li>
                                    <li><a href="logout.php">Cerrar Sesion</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <div class="imgUser">
                    <img src="../../../img/user/perfil.jpg" alt="user">
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
            
            <form id="buscar_nombres"><input type="text" id="Buscar" name="Buscar" value="" onkeyup="buscarC2(<?php echo $codigo ?>)" placeholder="Buscar nombre...">
           
            <div class="cardContent">
                <table>
                <tr>
               
               <th>Cedula</th>
               <th>Nombres</th>
               <th>Apellidos</th>
               <th>Telefono</th>
               <th>Fecha Nacimiento</th>
               <th>Correo</th>
               <th colspan="3">Administrar</th>
                </tr>

           <?php

               $sql = "SELECT * FROM usuario";
               $result = $conn->query($sql);

               if ($result->num_rows > 0){
                   while($row = $result->fetch_assoc()){
                       if($row["usu_eliminado"]!='S'){
                           echo "<tr>";
                           echo "<td>" .$row["usu_cedula"]."</td>";
                           echo "<td>" .$row["usu_nombres"]."</td>";
                           echo "<td>" .$row["usu_apellidos"]."</td>";
                           echo "<td>" .$row["usu_telefono"]."</td>";
                           echo "<td>" .$row["usu_fecha_nacimiento"]."</td>";
                           echo "<td>" .$row["usu_correo"]."</td>";
                           echo "<td class='accion'><a href='../controller/eliminar.php?codigo=".$row['usu_id']."&codigo_admin=".$codigo_admin."'>Eliminar</a></td>";
                           echo "<td class='accion'><a href='modificar.php?codigo=".$row['usu_id']."&codigo_admin=".$codigo_admin."'>Modificar</a></td>";
                           echo "<td class='accion'><a href='cambiar_contrasena.php?codigo=".$row['usu_id']."&codigo_admin=".$codigo_admin."'>Cambiar contrasena</a></td>";
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