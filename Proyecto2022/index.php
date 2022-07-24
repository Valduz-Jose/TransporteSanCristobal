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
    if(!empty($_POST['comentario'])&&!empty($_POST['nombre'])&&!empty($_POST['apellido'])&&!empty($_POST['correo'])&&!empty($_POST['tlf'])){
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
    <!-- <link rel="stylesheet" href="assets/style.css"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet">
    <title>Transporte San Cristobal</title>
    <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

</head>
<body>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Cabecera -->
<?php require 'partials/header.php'?>

<!-- Carrusel -->
<div id="carouselExampleDark" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" data-bs-interval="10000">
      <img src="assets/img/morning.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Adios al Colapso Vial</h5>
        <p>Con nuestro sistema de carril para Transporte aseguramos que llegues a tu destino evitando el embotellamiento.</p>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <img src="assets/img/taxi.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Todas las Rutas al alcance de un click</h5>
        <p>Usa nuestro buscador con la palabra clave de tu Inicio, Ruta o Destino y te mostraremos todas las rutas disponibles para esa zona.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/img/bus.jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Seguridad y Servicio</h5>
        <p>Nos preocupamos por nuestros usuarios por ello contamos con sistemas de vigilancia incorporada y velamos por hacer de su viaje lo mas placentero posible.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container text-center">
    <div class="row justify-content-md-center">
        
        <div class="cold-md-auto">
            <!-- BUSCADOR -->
            <label for="buscador1" class="visually-hidden ">Busca tu Ruta</label>
            <form name="buscador1" action="" method="get">
            <br><input type="text" class="form-control-plaintext border-primary" placeholder="Escribe tu Ruta" name="busqueda"><br>
            <input type="submit" class="btn btn-outline-primary btn-sm" name ="enviar"value="Buscar">
            </form>
        </div>
    </div>
</div> 


<div class="container-fluid">
    <?php
        if(isset($_GET['enviar'])){
            $busqueda=$_GET['busqueda'];
            $consulta = $conect->query("SELECT * FROM rutas WHERE (ruta LIKE '%$busqueda%')OR(inicio LIKE '%$busqueda%')OR(fin LIKE '%$busqueda%') ");//encuentra la palabra
    ?>      <table id="routes" class="table caption-top border-dark table-primary table s-m" >
                <figure class="text-center">
                    <caption><h4>Rutas Encontradas</h4></caption>
                </figure>
            <thead class="datos_rutas">
                    <th>Empresa</th>
                    <th>Inicio</th>
                    <th>Ruta</th>
                    <th>Fin</th>
                    <th>Costo</th><br>
            </thead>
            <tbody>
    <?php        while($row=$consulta->fetch_array()){?>
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
</div>    
<!--/BUSCADOR  -->
<div class="container-fluid">
    <!-- Muestra de Rutas -->
    <br>
        <table class="table caption-top border-dark table-primary table s-m" id="routes">
            <caption><h4>Todas las Rutas</h4></caption>
            
            <thead class="datos_rutas ">
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
</div>
    
    <!-- Creacion de las distintas funcionalidades segun el Usuario -->
    <?php if(!empty($user)){
        if ($user['tipo']==0){
        
    ?>
        <?php if(!empty($message)):?>
        <p><?= $message ?></p>
        <?php endif; ?>
        <form action="index.php" method="post">
            <figure class="text-center">
                <label for="buzon"><h3>Buzón de Criticas y Sugerencias</h3></label>
            </figure>
            <div class="container-fluid">
                <div class="mb-3 col-6 mx-auto">
                    <input class="form-control" type="text" name="nombre" placeholder="Nombre" id="">
                </div>
                <div class="mb-3 col-6 mx-auto">
                    <input class="form-control" type="text" name="apellido" placeholder="Apellido" id="">
                </div>
                <div class="mb-3 col-6 mx-auto">
                    <input class="form-control" type="text" name="correo" placeholder="correo" id="">
                </div>
                <div class="mb-3 col-6 mx-auto">
                    <input class="form-control" type="text" name="tlf" placeholder="#Telefono" id="">
                </div>
                <div class="mb-3 col-6 mx-auto">
                    <label for="empresa_l" class="form-label">Empresa a la que se dirije el Comentario</label>
                    <select class="form-select" name="empresa_l" id="empresas">
                    <option value="Ninguna">Ninguna</option>
                    <?php
                        while($most=mysqli_fetch_array($resulted)){
                            
                        ?>
                            <option value="<?php echo $most['empresa']; ?>"><?php echo $most['empresa']; ?></option>
                            
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-6 mx-auto">
                    <input type="text" class="form-control"  name="comentario" placeholder="Comentario" id="">
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="submit" class="btn btn-primary" class="btn btn-primary" value="Enviar">
                </div>
            </div>
        </form>
        
    <?php
    }else if($user['tipo']==1803){
    ?>
        <div class="container-fluid">
            <div class="d-grid gap-2 col-6 mx-auto">
                <a class="btn btn-primary" role="button" href="admin.php">Añadir Nueva Ruta</a>
            </div>
        </div>
    <?php
    }else if($user['tipo']==777){
    ?>
    <div class="container-fluid">
        <div class="d-grid gap-2 col-6 mx-auto">
            <a class="btn btn-primary" role="button" href="alcaldia.php">Ver Buzón de Sugerencias</a>    
        </div>
    </div>
    <?php
    }}
    ?>
    <!-- Creacion de las distintas funcionalidades segun el Usuario -->
    <figure class="text-center">
        <!-- Loggin, Singup, Loggout -->
        <?php if(!empty($user)):?>
            <?php require 'partials/footer.php'?>
        <?php else: ?>
            <h3>Porfavor Logueate o Registrate</h3>
            <a href="login.php" class="btn btn-primary" role="button">Login</a>    
            <a href="singup.php"class="btn btn-secondary" role="button">Singup</a>
        <?php endif ;?>
    </figure>
</body>
</html>
<!-- 
    Universidad Nacional Experimental del Táchira
    Prof: Marcel Molina

    Progrmación y Diseño
    José Alejandro Valduz Contreras 26841447
    Frank Benitez 26156872
 -->