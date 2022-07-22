<?php
    require 'database.php';
    
    $message='';

    if(!empty($_POST['empresa']) && !empty($_POST['inicio']) && !empty($_POST['ruta']) && !empty($_POST['fin']) && !empty($_POST['costo'])){
    //    se crea la variable para conectar y las variables que se enviaran
        $sql = "INSERT INTO rutas(empresa,inicio,ruta,fin,costo) VALUES (:empresa, :inicio, :ruta, :fin, :costo)";
        //stmt es la conexion a ejecutar y preparar
        $stmt=$conn->prepare($sql);
        //vincular parametros
        $stmt->bindParam(':empresa',$_POST['empresa']);
        $stmt->bindParam(':inicio',$_POST['inicio']);
        $stmt->bindParam(':ruta',$_POST['ruta']);
        $stmt->bindParam(':fin',$_POST['fin']);
        $stmt->bindParam(':costo',$_POST['costo']);
        // Si al ejecutar funciona o no
        if($stmt->execute()){
            $message = 'Nueva Ruta Añadida';
        }else{
            $message = 'La Ruta no se pudo Añadir';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Administración</title>
</head>
<body>
<?php require 'partials/header.php'?>
    <h1>Añadir Nueva Ruta</h1>
    <form action="admin.php" method="post">
            <?php if(!empty($message)):?>
            <p><?= $message ?></p>
            <?php endif; ?> 

            <input type="text" name="empresa"placeholder="Empresa que cubre la ruta" id="empresa">
            <input type="text" name="inicio" placeholder="Punto de Inicio" id="">
            <input type="text" name="ruta" placeholder="Recorrido" id="">
            <input type="text" name="fin" placeholder="Punto de Fin" id="">
            <input type="text" name="costo" placeholder="Monto en Bs" id="">
            <input type="submit" name="enviar" value="Añadir">
            
    </form>
</body>
</html>