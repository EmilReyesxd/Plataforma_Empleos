<?php
require_once '../../config/db.php';
require_once '../../helpers/session.php';

if (!isEmpresa()) header("Location: ../auth/login.php");
$id_of = (int)$_GET['id'];
$apps  = $conn->query(
  "SELECT a.*, c.nombre, c.apellido, c.correo, c.cv_pdf
   FROM aplicaciones a JOIN candidatos c ON a.id_candidato=c.id_candidato
   WHERE a.id_oferta=$id_of"
);
?>
<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Candidatos</title>
<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Estilos personalizados -->
    <link rel="stylesheet" href="../../assets/css/style.css">
<link href="../../assets/css/style.css" rel="stylesheet"></head>
<body>
<?php include '../componentes/navbar.php'; ?>
<div class="container">
  <h2>Candidatos Aplicados</h2>
  <table class="table">
    <tr><th>Nombre</th><th>Correo</th><th>CV</th></tr>
    <?php while($c=$apps->fetch_assoc()): ?>
    <tr>
      <td><?=$c['nombre']?> <?=$c['apellido']?></td>
      <td><?=$c['correo']?></td>
      <td>
        <?php if($c['cv_pdf']): ?>
          <a href="../../assets/uploads/<?=basename($c['cv_pdf'])?>" target="_blank">Ver CV</a>
        <?php else: ?>No disponible<?php endif; ?>
      </td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>
<?php include '../componentes/footer.php'; ?>
</body>
</html>
