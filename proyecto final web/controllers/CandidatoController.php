<?php
require_once '../modelos/Candidato.php';
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accion = $_POST['accion'];

    // Acción de registro
    if ($accion === 'registrar') {
        $candidato = new Candidato();
        $candidato->registrar($_POST, $_FILES);
    }

    // Acción de login
    if ($accion === 'login') {
        $candidato = new Candidato();
        $candidato->login($_POST);
    }

    // Acción de logout
    if ($accion === 'logout') {
        // Asegúrate de que la sesión esté iniciada
        session_start();
        
        // Vacía las variables de sesión
        $_SESSION = [];

        // Elimina la cookie de sesión, si está configurada
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, 
                $params["path"], $params["domain"], 
                $params["secure"], $params["httponly"]
            );
        }

        // Destruye la sesión
        session_destroy();

        // Redirige al login después de cerrar sesión
        header("Location: ../vistas/login.php");
        exit;  // Asegúrate de que no se ejecute más código después de la redirección
    }
}
?>
