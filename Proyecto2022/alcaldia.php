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
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Buzon de Mensajes</title>
</head>
<body>
    
    <!-- Cabecera -->
    <?php require 'partials/header.php'?>
    <figure class="text-center">
        <h1>Buzon de Sugerencias</h1>
    </figure>
    <?php
    while($most=mysqli_fetch_array($resulted)){
    ?>
    <br>
    <div class="container fluid ">
        <div class="card text-center border-primary ">
                    <div class="card border-primary">
                        <div class="card header "><p><?php echo "Usuario: ".$most['user'] ?></div>
                        <div class="card-body">
                            <h5 class="card-title"><?php echo "Dirigida a: ".$most['empresa_l'];?></h5>
                            <p class="card-text"><?php echo "Comentario: ".$most['comentario']; ?></p>
                        </div>
                        <div class="card-footer bg-transparent border-succes"><?php echo "Nombre y apellido: ".$most['nombre']." ".$most['apellido']." correo de contacto: ".$most['correo']." Telefono: ".$most['tlf']; ?></div>
                    </div> 
        </div>
    </div>
    <?php
    }
    ?>
</body>
<?php require 'partials/footer.php'?>
</html>