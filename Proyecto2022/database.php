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