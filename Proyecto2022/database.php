<!-- Conexion a Base de Datos -->
<?php
    $server='localhost';
    $username='root';
    $password='';
    $database='database_transporte';
    try{
        $conn=new PDO("mysql:host=$server;dbname=$database;",$username,$password);
    }catch(PDOException $e){
        die('connected failed: '.$e->getMessage());
    }
?>
<!-- 
    Universidad Nacional Experimental del Táchira
    Prof: Marcel Molina

    Progrmación y Diseño
    José Alejandro Valduz Contreras 26841447
    Frank Benitez 26156872
 -->