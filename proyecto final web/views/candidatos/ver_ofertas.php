<?php
require_once '../../config/db.php';
require_once '../../helpers/session.php';

if (!isCandidato()) header("Location: ../auth/login.php");
$ofertas = $conn->query(
  "SELECT o.*, e.nombre AS empresa 
   FROM ofertas o JOIN empresas e ON o.id_empresa=e.id_empresa"
);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Ofertas</title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/css/style.css" rel="stylesheet"></head>
<body>
<?php include '../componentes/navbar.php'; ?>
<div class="container">
  <h2>Ofertas Disponibles</h2>
  <?php while($o = $ofertas->fetch_assoc()): ?>
    <div class="card">
      <div class="card-body">
        <h5><?=$o['titulo']?></h5>
        <p><?=$o['descripcion']?></p>
        <form method="POST" action="../../controllers/AplicacionController.php">
          <input type="hidden" name="accion" value="aplicar">
          <input type="hidden" name="id_oferta" value="<?=$o['id_oferta']?>">
          <button class="btn btn-primary">Aplicar</button>
        </form>
      </div>
    </div>
  <?php endwhile; ?>
</div>
<?php include '../componentes/footer.php'; ?>
</body>
</html>
