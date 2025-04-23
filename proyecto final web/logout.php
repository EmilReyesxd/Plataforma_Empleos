<?php
require_once __DIR__ . '/helpers/session.php';

logout();

// Redirigir a login después de cerrar sesión
header("Location: /plataforma-empleos/views/auth/login.php?logout=true");
exit;

