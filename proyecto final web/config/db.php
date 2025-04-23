<?php
$host = "localhost";
$usuario = "root";
$password = "serr200482";
$base_datos = "plataforma_empleos";

$conn = new mysqli($host, $usuario, $password, $base_datos);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
