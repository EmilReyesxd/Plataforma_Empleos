<?php
require_once '../../helpers/session.php';

if (!isEmpresa()) header("Location: ../auth/login.php");
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Nueva Oferta</title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/css/style.css" rel="stylesheet"></head>
<body>
<?php include '../componentes/navbar.php'; ?>
<div class="container">
  <h2>Crear Oferta</h2>
  <form method="POST" action="../../controllers/OfertaController.php">
    <input type="hidden" name="accion" value="crear_oferta">
    <input name="titulo" placeholder="Título" class="form-control" required>
    <textarea name="descripcion" placeholder="Descripción" class="form-control" required></textarea>
    <textarea name="requisitos" placeholder="Requisitos" class="form-control" required></textarea>
    <button class="btn btn-success mt-2">Crear</button>
  </form>
</div>
<?php include '../componentes/footer.php'; ?>
</body>
</html>
