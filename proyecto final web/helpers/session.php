<?php
// Inicia sesión solo si no se ha iniciado aún
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verifica si hay un usuario logueado
function isLoggedIn() {
    return isset($_SESSION['usuario']) && isset($_SESSION['tipo']);
}

// Verifica si el usuario es empresa
function isEmpresa() {
    return isLoggedIn() && $_SESSION['tipo'] === 'empresa';
}

// Verifica si el usuario es candidato
function isCandidato() {
    return isLoggedIn() && $_SESSION['tipo'] === 'candidato';
}

// Cierra sesión limpiamente
function logout() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Limpiar variables de sesión
    $_SESSION = [];

    // Borrar cookie de sesión
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"] ?? '/',
            $params["domain"] ?? '',
            $params["secure"] ?? false,
            $params["httponly"] ?? false
        );
    }

    // Destruir sesión
    session_destroy();
}
