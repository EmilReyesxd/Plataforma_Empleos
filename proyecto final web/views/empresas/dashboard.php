<?php
require_once '../../helpers/session.php';
require_once '../../config/db.php';

if (!isEmpresa()) {
    header("Location: ../auth/login.php");
    exit;
}

// Aquí puedes cargar la lógica del panel de empresa si aplica

?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Empresa</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<?php include '../../views/componentes/navbar.php'; ?>
<div class="container mt-5">
  <h2>Bienvenido Empresa <?= htmlspecialchars($_SESSION['correo']) ?></h2>

  <a href="nueva_oferta.php" class="btn btn-success mt-3">Publicar Oferta</a>
  <a href="ver_candidatos.php" class="btn btn-info mt-3 ms-2">Ver Postulantes</a>
</div>
<?php include '../../views/componentes/footer.php'; ?>
</body>
</html>
