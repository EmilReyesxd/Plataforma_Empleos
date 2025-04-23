<?php

//session_start();

 //Cierra la sesión y redirige siempre al login
//session_destroy(); // Esto destruye la sesión actual

 //Redirige al login siempre
//header("Location: views/auth/login.php");
//exit;

require_once 'helpers/session.php';

 //Redirigir a la página de inicio correspondiente si el usuario está logueado
if (isLoggedIn()) {
    header("Location: views/{$_SESSION['tipo']}s/dashboard.php");
    exit;
} else {
     //Si no está logueado, redirigir al login
    header("Location: views/auth/login.php");
    exit;
}
?>
