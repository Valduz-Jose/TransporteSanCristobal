<?php 
    require 'database.php';
    
    $message='';
    $message2='';
    if(!empty($_POST['email']) && !empty($_POST['password']) ){
    //    se crea la variable para conectar y las variables que se enviaran
        $sql = "INSERT INTO users(email, password, tipo) VALUES (:email, :password, :tipo)";
        //stmt es la conexion a ejecutar y preparar
        $stmt=$conn->prepare($sql);
        //vincular parametros
        if($_POST['password']==$_POST['confirm-password']){
            $stmt->bindParam(':email',$_POST['email']);
            // lo guardamos en una variable y lo ciframos
            $password= password_hash($_POST['password'],PASSWORD_BCRYPT);
            // vincular parametros
            $stmt->bindParam(':password',$password);
            if($_POST['tipo']=='777'||$_POST['tipo']=='1803'){
                $stmt->bindParam(':tipo',$_POST['tipo']);
            }else{
                $_POST['tipo']='0';
                $stmt->bindParam(':tipo',$_POST['tipo']);
            }
            
            // Si al ejecutar funciona o no
            
        }else{
            $message2='La Contraseña debe ser Igual ';
        }
        if($stmt->execute()){
            $message = 'Usuario Creado';
        }else{
            $message = $message2.'Lo sentimos el Usuario no se ha Creado';
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"><title>Singup</title>
    <title>Singup</title>
</head>
<body>
<?php require 'partials/header.php'?>

<div class="container-fluid">
<!-- ALERTAS -->
<?php if(!empty($message)){?>
            <?php if($message=='Usuario Creado'){?>
                <div class="alert alert-success" role="alert">
                    <?= $message ?>
                </div>
            <?php }else{?>
                <div class="alert alert-danger" role="alert">
                    <?= $message ?>
                </div>
            <?php }?>
        <?php } ?>
        <figure class="text-center">
            <h1>Singup</h1>
            <span>o <a class="btn btn-dark" role="button" href="login.php">Login</a></span>        
        </figure>
</div>

<form action="singup.php" method="post">
    <div class="container-fluid">
        <div class="mb-3 col-6 mx-auto">
            <label for="email" class="form-label">Correo</label>
            <input type="email" id="email" class="form-control" name="email" placeholder="name@example.com" id="">
        </div>
        <div class="mb-3 col-6 mx-auto">
        <label for="password" class="form-label">Contraseña</label>
               <input type="password" id="password" class="form-control" name="password" placeholder="Enter your Password">
        </div>
        <div class="mb-3 col-6 mx-auto">
        <label for="confirm-contraseña" class="form-label">Confirmar Contraseña</label>
               <input type="password" id="confirm-contraseña" class="form-control" name="confirm-password" placeholder="Confirm your Password">
        </div>
        <div class="mb-3 col-6 mx-auto">
            <label for="tipo" class="form-label">Credenciales</label>
            <input type="text" id="tipo" class="form-control" name="tipo" placeholder="Si es un usuario normal coloque 0" id="">
        </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <input type="Submit" class="btn btn-primary mb-3" value="Enviar">
            </div>
        </div>
    </div>
</form>
</body>
<footer>
    <figure class="text-center">
        <!-- Date -->
        <label for="" class="form-label"><?php echo date("d/m/Y" ) ?></label>
        <!-- DATE -->
        </figure>
</footer>
</html>
<!-- 
    Universidad Nacional Experimental del Táchira
    Prof: Marcel Molina

    Progrmación y Diseño
    José Alejandro Valduz Contreras 26841447
    Frank Benitez 26156872
 -->