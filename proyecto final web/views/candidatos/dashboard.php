<?php
require_once '../../helpers/session.php';
require_once '../../config/db.php';

if (!isCandidato()) {
    header("Location: ../auth/login.php");
    exit;
}

// Verificar si el candidato ya tiene CV
$idCandidato = $_SESSION['usuario'];
$sql = "SELECT id_curriculum FROM curriculum WHERE id_candidato = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idCandidato);
$stmt->execute();
$result = $stmt->get_result();
$tieneCV = $result->num_rows > 0;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Candidato</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<?php include '../../views/componentes/navbar.php'; ?>
<div class="container mt-5">
  <h2>Bienvenido Candidato <?= htmlspecialchars($_SESSION['correo']) ?></h2>

  <?php if ($tieneCV): ?>
    <a href="editar_cv.php" class="btn btn-primary mt-3">Editar Currículum</a>
  <?php else: ?>
    <a href="crear_cv.php" class="btn btn-success mt-3">Crear Currículum</a>
  <?php endif; ?>

  <a href="ver_ofertas.php" class="btn btn-info mt-3 ms-2">Ver Ofertas</a>
</div>
<?php include '../../views/componentes/footer.php'; ?>
</body>
</html>
