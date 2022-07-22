<?php
//inicializo
    session_start();
//quito la sesion
    session_unset();
//Destruye la sesion
    session_destroy();
// Redirecciono
    header('Location: /proyecto2022');
?>