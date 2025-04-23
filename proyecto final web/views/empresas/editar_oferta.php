<?php
require_once '../../config/db.php';
require_once '../../helpers/session.php';

if (!isEmpresa()) header("Location: ../auth/login.php");
$id = (int)$_GET['id'];
$of = $conn->query("SELECT * FROM ofertas WHERE id_oferta=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Editar Oferta</title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/css/style.css" rel="stylesheet"></head>
<body>
<?php include '../componentes/navbar.php'; ?>
<div class="container">
  <h2>Editar Oferta</h2>
  <form method="POST" action="../../controllers/OfertaController.php">
    <input type="hidden" name="accion" value="editar_oferta">
    <input type="hidden" name="id_oferta" value="<?=$id?>">
    <input name="titulo" value="<?=$of['titulo']?>" class="form-control" required>
    <textarea name="descripcion" class="form-control" required><?=$of['descripcion']?></textarea>
    <textarea name="requisitos" class="form-control" required><?=$of['requisitos']?></textarea>
    <button class="btn btn-primary mt-2">Actualizar</button>
  </form>
</div>
<?php include '../componentes/footer.php'; ?>
</body>
</html>
