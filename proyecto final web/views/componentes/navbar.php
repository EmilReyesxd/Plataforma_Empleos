<?php
// Inicia sesión si no está iniciada (protección doble)
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../../helpers/session.php';
?>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="/index.php">Empleos</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <?php if (isLoggedIn()): ?>
          <?php if (isCandidato()): ?>
            <li class="nav-item"><a class="nav-link" href="/plataforma-empleos/views/candidatos/dashboard.php">Mi Panel</a></li>
          <?php elseif (isEmpresa()): ?>
            <li class="nav-item"><a class="nav-link" href="/plataforma-empleos/views/empresas/dashboard.php">Mi Panel</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link text-danger" href="/plataforma-empleos/logout.php">Cerrar sesión</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="/plataforma-empleos/views/auth/login.php">Iniciar Sesión</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
