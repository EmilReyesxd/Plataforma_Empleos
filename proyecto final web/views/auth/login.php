<?php
require_once __DIR__ . '/../../helpers/session.php';

// Solo redirige si la sesión sigue activa y la variable existe
if (isset($_SESSION['usuario']) && isset($_SESSION['tipo'])) {
    header("Location: /plataforma-empleos/views/{$_SESSION['tipo']}s/dashboard.php");

    exit;
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Iniciar Sesión</h2>

        <!-- Formulario de login -->
        <form method="POST" action="../../controllers/AuthController.php" class="mt-4">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" class="form-control" placeholder="Correo" required>
            </div>
            <div class="mb-3">
                <label for="contraseña" class="form-label">Contraseña</label>
                <input type="password" id="contraseña" name="contraseña" class="form-control" placeholder="Contraseña" required>
            </div>
            <div class="mb-3">
                <button name="login" class="btn btn-primary w-100">Ingresar</button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <p>¿No tienes cuenta? <a href="registro_candidato.php">Registro Candidato</a> | <a href="registro_empresa.php">Registro Empresa</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
