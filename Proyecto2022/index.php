<?php
    session_start();

    require 'database.php';
    $message='';
    if(isset($_SESSION['user_id'])){
        $records = $conn->prepare('SELECT * FROM users WHERE id = :id');
        $records->bindParam(':id',$_SESSION['user_id']);
        $records->execute();
        $results = $records->fetch(PDO::FETCH_ASSOC);
        $users =null;
        if(count($results)>0){
            $user=$results;
        }

    }
    // Para Imprimir Todas las Rutas
    $conexion=mysqli_connect('localhost','root','','database_transporte');
    $sql="SELECT * FROM rutas";
    $resultado=mysqli_query($conexion,$sql);
    //Para acceder a las rutas en el select
    $conect=mysqli_connect('localhost','root','','database_transporte');
    $man="SELECT * FROM rutas";
    $resulted=mysqli_query($conect,$man);

// GUARDO EN LA BASE DE DATOS LOS COMENTARIO
    if(!empty($_POST['comentario'])){
        //    se crea la variable para conectar y las variables que se enviaran
            $com = "INSERT INTO comentarios(nombre,apellido,correo,tlf,empresa_l,user,comentario) VALUES (:nombre,:apellido,:correo,:tlf,:empresa_l,:user, :comentario)";
            //stmt es la conexion a ejecutar y preparar
            $stmt=$conn->prepare($com);
            //vincular parametros
            $stmt->bindParam(':nombre',$_POST['nombre']);
            $stmt->bindParam(':apellido',$_POST['apellido']);
            $stmt->bindParam(':correo',$_POST['correo']);
            $stmt->bindParam(':tlf',$_POST['tlf']);
            $stmt->bindParam(':empresa_l',$_POST['empresa_l']);
            $usuario=$user['email'];
            $stmt->bindParam(':user',$usuario);
            $stmt->bindParam(':comentario',$_POST['comentario']);
            
            // Si al ejecutar funciona o no
            if($stmt->execute()){
                $message = 'Comentario Enviado';
            }else{
                $message = 'Su comentario no pudo ser enviado';
            }
    }
// ----------------------------------------------
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Transporte San Cristobal</title>
    
</head>
<body>
    <!-- Cabecera -->
    <?php require 'partials/header.php'?>
<h1>Transporte San Cristobal</h1>

<!-- BUSCADOR -->
<label for="buscador1">Busca tu Ruta</label>
    <form name="buscador1" action="" method="get">
        <input type="text" name="busqueda">
        <input type="submit" name ="enviar"value="Buscar">
    </form>
    <table id="routes" >
        <h2>Rutas Encontradas</h2>
    <thead class="datos_rutas">
            <th>Empresa</th>
            <th>Inicio</th>
            <th>Ruta</th>
            <th>Fin</th>
            <th>Costo</th><br>
    </thead>
    <tbody>
    <?php
    if(isset($_GET['enviar'])){
        $busqueda=$_GET['busqueda'];
        $consulta = $conect->query("SELECT * FROM rutas WHERE (ruta LIKE '%$busqueda%')OR(inicio LIKE '%$busqueda%')OR(fin LIKE '%$busqueda%') ");//encuentra la palabra
        while($row=$consulta->fetch_array()){?>
            <tr>
                <td><?php echo $row['empresa']?></td>
                <td><?php echo $row['inicio']?></td>
                <td><?php echo $row['ruta']?></td>
                <td><?php echo $row['fin']?></td>
                <td><?php echo $row['costo']." Bs"?></td>
            </tr>
        <?php }}
    ?>
    </tbody>
    </table>
<!--/BUSCADOR  -->

<!-- Muestra de Rutas -->
<h2>Todas las Rutas</h2>
    <table id="routes">
        <thead class="datos_rutas">
            <th>Empresa</th>
            <th>Inicio</th>
            <th>Ruta</th>
            <th>Fin</th>
            <th>Costo</th><br>
        </thead>
        <tbody>
            <?php
            $i=0;
            while($mostrar=mysqli_fetch_array($resultado)){
                
            ?>
            <tr>
                <td><?php echo $mostrar['empresa']?></td>
                <td><?php echo $mostrar['inicio']?></td>
                <td><?php echo $mostrar['ruta']?></td>
                <td><?php echo $mostrar['fin']?></td>
                <td><?php echo $mostrar['costo']." Bs"?></td>
            </tr>
            <?php
            $i++;}
            ?>
        </tbody>
    </table><br><br>
    
    <!-- Creacion de las distintas funcionalidades segun el Usuario -->
    <?php if(!empty($user)){
        if ($user['tipo']==0){
        
    ?>
        <?php if(!empty($message)):?>
        <p><?= $message ?></p>
        <?php endif; ?>
        <form action="index.php" method="post">
            <label for="buzon">Buzón de Criticas y Sugerencias</label>
            <input type="text" name="nombre" placeholder="Nombre" id="">
            <input type="text" name="apellido" placeholder="Apellido" id="">
            <input type="text" name="correo" placeholder="correo" id="">
            <input type="text" name="tlf" placeholder="#Telefono" id="">
            <label for="empresa_l" class="labeltexto">Empresa a la que se dirije el Comentario</label>
            <select name="empresa_l" id="empresas">
                <option value="Ninguna">Ninguna</option>
                <?php
                    while($most=mysqli_fetch_array($resulted)){
                        
                    ?>
                        <option value="<?php echo $most['empresa']; ?>"><?php echo $most['empresa']; ?></option>
                        
                    <?php
                    }
                    ?>
            </select>
            
            <input type="text" name="comentario" placeholder="Comentario" id="">
            <input type="submit" value="Enviar">
        </form>
        
    <?php
    }else if($user['tipo']==1803){
    ?>
        
        <a href="admin.php"><input type="button" value="Añadir Nueva Ruta" ></a>
    <?php
    }else if($user['tipo']==777){
    ?>
        <a href="alcaldia.php"><input type="button" value="Ver Buzón de Sugerencias" ></a>    
    <?php
    }}
    ?>

    <!-- Loggin, Singup, Loggout -->
    <?php if(!empty($user)):?>
        <br>Bienvenido <?= $user['email'];?>
        <br>Te has logueado Correctamente
        <a href="logout.php">Logout</a>
    <?php else: ?>
        <h1>Porfavor Logueate o Registrate</h1>
        <a href="login.php">Login</a>    
        <a href="singup.php">Singup</a>
    <?php endif ;?>
    </body>
</html>