<?php
    session_start();

    require 'database.php';
    $message='';
    $conect=mysqli_connect('localhost','root','','database_transporte');
    $man="SELECT * FROM comentarios";
    $resulted=mysqli_query($conect,$man);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Buzon de Mensajes</title>
</head>
<body>
    
    <!-- Cabecera -->
    <?php require 'partials/header.php'?>
    <h1>Buzon de Sugerencias</h1>
    <?php
    while($most=mysqli_fetch_array($resulted)){
    ?>
        <div>
            <p><?php echo "Comentario: ".$most['comentario']; ?></p><br>
            <p><?php echo "Datos "."Usuario: ".$most['user']." Nombre y apellido: ".$most['nombre']." ".$most['apellido']." correo de contacto: ".$most['correo']." Telefono: ".$most['tlf']; ?></p>
            <p><?php echo " Empresa a la que va dirigida: ".$most['empresa_l'];?></p>
        </div>
    <?php
    }
    ?>
    <br>Te has logueado Correctamente
    <a href="logout.php">Logout</a>
</body>
</html>