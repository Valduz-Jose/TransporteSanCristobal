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
            $stmt->bindParam(':tipo',$_POST['tipo']);
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
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"><title>Singup</title>
    <title>Singup</title>
</head>
<body>
<?php require 'partials/header.php'?>

<?php if(!empty($message)):?>
    <p><?= $message ?></p>
<?php endif; ?>

<h1>Singup</h1>
<span>o <a href="login.php">Login</a></span>
<form action="singup.php" method="post">
        <input type="text" name="email" placeholder="Enter your Email" id="">
        <input type="password" name="password" placeholder="Enter your Password">
        <input type="password" name="confirm-password" placeholder="Confirm your Password">
        <input type="text" name="tipo" placeholder="Credenciales. (Si es un usuario normal coloque 0)" id="">
        <input type="Submit" value="Enviar">
    </form>
</body>
</html>