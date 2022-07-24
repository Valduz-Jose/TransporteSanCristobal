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
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    
    <title>Administración</title>
</head>
<body>
<?php require 'partials/header.php'?>
<figure class="text-center">
        <br><h1>Añadir Nueva Ruta</h1>
</figure>
    <form action="admin.php" method="post">
        <!-- ALERTAS -->
        <?php if(!empty($message)){?>
            <?php if($message=='La Ruta no se pudo Añadir'){?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php }else{?>
                <div class="alert alert-success" role="alert">
                    <?= $message ?>
                </div>
            <?php }?>
        <?php } ?>
        <div class="container-fluid">
            <div class="mb-3 col-6 mx-auto">
                <label for="empresa" class="form-label">Empresa</label>
                <input class="form-control" type="text" name="empresa"placeholder="Nombre Empresa" id="empresa">
            </div>
            <div class="mb-3 col-6 mx-auto">
            <label for="inicio" class="form-label">Punto de Inicio</label>
                <input class="form-control" type="text" name="inicio" placeholder="Salida" id="inicio">
            </div>
            <div class="mb-3 col-6 mx-auto">
            <label for="ruta" class="form-label">Ruta</label>
                <input class="form-control" type="text" name="ruta" placeholder="Recorrido" id="ruta">
            </div>
            <div class="mb-3 col-6 mx-auto">
            <label for="fin" class="form-label">Punto de Fin</label>
                <input class="form-control" type="text" name="fin" placeholder="Lugar de Llegada" id="fin">
            </div>
            <div class="mb-3 col-6 mx-auto">
            <label for="costo" class="form-label">Precio del Pasaje</label>
                <input class="form-control" type="text" name="costo" placeholder="Monto en Bs" id="costo">
            </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="submit" class="btn btn-primary"  name="enviar" value="Añadir">
                </div>
            </div>
        </div>
    </form>
</body>
<?php require 'partials/footer.php'?>
</html>