<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header('Location: /proyecto2022');
    }
    require 'database.php'; //conectamos
    //si no esta vacio comprobamos 
    if(!empty($_POST['email'])&&!empty($_POST['password'])){//
        //tratamos de consultar a traves de la conexion con select obtenemos los datos y desde donde
        $records =$conn->prepare('SELECT *  FROM users WHERE email = :email');
        //vinculamos el parametro que recibe con el de la base
        $records->bindParam(':email',$_POST['email']);
        //ejecutamos la consulta
        $records->execute();
        //obtenemos los datos del usuario
        $results = $records->fetch(PDO::FETCH_ASSOC);
        //mensaje por pantalla
        $message='';
        if(is_countable($results)){
            if(count($results)>0){
                if(password_verify($_POST['password'],$results['password'])){
                    $_SESSION['user_id']=$results['id'];//almacena
                    if($results['tipo']==0){//usuario normal
                        header('Location: /proyecto2022');//redirecciona
                    }else if($results['tipo']==1803){//admin
                        header('Location: /proyecto2022/admin.php');//redirecciona
                    }else if($results['tipo']==777){//Alcaldia
                        header('Location: /proyecto2022/alcaldia.php');//redirecciona
                    }else{
                        $message="Credenciales Incorrectas";
                    }
                }else{
                    $message="Contraseña Incorrecta";
                }
                
                
            }else{
                $message="Ingrese Todos Los datos";
                
            }
    
        }else{
            $message="Registrate Primero ve a Singup";
        }
        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<?php require 'partials/header.php'?>
    <div class="container-fluid">
        <!-- ALERTAS -->
<?php if(!empty($message)):?>
<div class="alert alert-danger" role="alert">
  <?= $message ?>
</div>
<?php endif;?>

        <figure class="text-center">
            <h1>Login</h1>
            <span>o <a class="btn btn-dark" role="button" href="singup.php">Singup</a></span>        
        </figure>
    </div>
    
    <form action="login.php" method="post">
        <div class="container-fluid">
            <div class="mb-3 col-6 mx-auto">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="name@example.com" id="">
            </div>
            <div class="mb-3 col-6 mx-auto">
                <label for="password" class="forml-label">Contraseña</label>
                <input type="password" class="form-control" name="password" placeholder="Enter your Password">
            </div>
            <!-- <div class="mb-3 col-6 mx-auto">
                <label for="tipo" class="form-label">Credenciales</label>
                <input type="text" name="tipo" class="form-control" placeholder="0 usuarios normales" id="">
            </div> -->
            <div class="d-grid gap-2 col-6 mx-auto">
                <input type="Submit" class="btn btn-primary mb-3"  value="Enviar">
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