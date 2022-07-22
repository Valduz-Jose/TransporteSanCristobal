<?php
    session_start();
    if(isset($_SESSION['user_id'])){
        header('Location: /proyecto2022');
    }
    require 'database.php'; //conectamos
    //si no esta vacio comprobamos 
    if(!empty($_POST['email'])&&!empty($_POST['password'])){//
        //tratamos de consultar a traves de la conexion con select obtenemos los datos y desde donde
        $records =$conn->prepare('SELECT id, email,password,tipo FROM users WHERE email = :email');
        //vinculamos el parametro que recibe con el de la base
        $records->bindParam(':email',$_POST['email']);
        //ejecutamos la consulta
        $records->execute();
        //obtenemos los datos del usuario
        $results = $records->fetch(PDO::FETCH_ASSOC);
        //mensaje por pantalla
        $message='';
        if(count($results)>0 && password_verify($_POST['password'],$results['password'])&& $_POST['tipo']==$results['tipo']){
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
            $message="Las Credenciales no coinciden";
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
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
</head>
<body>
<?php require 'partials/header.php'?>
    
    <?php if(!empty($message)):?>
        <p><?= $message ?></p>
    <?php endif;?>
    <h1>Login</h1>
    <span>o <a href="singup.php">Singup</a></span>
    
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Enter your Email" id="">
        <input type="password" name="password" placeholder="Enter your Password">
        <input type="text" name="tipo" placeholder="Credenciales" id="">
        <input type="Submit" value="Enviar">
    </form>
</body>
</html>