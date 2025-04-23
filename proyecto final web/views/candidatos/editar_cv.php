<?php
require_once '../../helpers/session.php';
require_once '../../config/db.php';

if (!isCandidato()) header("Location: ../auth/login.php");

// Verificar si el candidato tiene un currículum
$idCandidato = $_SESSION['usuario']; // ID del candidato desde la sesión
$sql = "SELECT * FROM curriculum WHERE id_candidato = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idCandidato);
$stmt->execute();
$result = $stmt->get_result();
$curriculum = $result->fetch_assoc();

if (!$curriculum) {
    echo "No se ha encontrado un currículum para este candidato. Crea uno primero.";
    exit; // Termina el script si no se encuentra el currículum
}

// Obtener la información adicional del currículum
$sqlFormacion = "SELECT * FROM formaciones WHERE id_curriculum = ?";
$stmtFormacion = $conn->prepare($sqlFormacion);
$stmtFormacion->bind_param("i", $curriculum['id_curriculum']);
$stmtFormacion->execute();
$resultFormacion = $stmtFormacion->get_result();
$formaciones = $resultFormacion->fetch_all(MYSQLI_ASSOC);

$sqlExperiencia = "SELECT * FROM experiencias WHERE id_curriculum = ?";
$stmtExperiencia = $conn->prepare($sqlExperiencia);
$stmtExperiencia->bind_param("i", $curriculum['id_curriculum']);
$stmtExperiencia->execute();
$resultExperiencia = $stmtExperiencia->get_result();
$experiencias = $resultExperiencia->fetch_all(MYSQLI_ASSOC);

$sqlHabilidades = "SELECT * FROM curriculum_habilidad JOIN habilidades ON curriculum_habilidad.id_habilidad = habilidades.id_habilidad WHERE id_curriculum = ?";
$stmtHabilidades = $conn->prepare($sqlHabilidades);
$stmtHabilidades->bind_param("i", $curriculum['id_curriculum']);
$stmtHabilidades->execute();
$resultHabilidades = $stmtHabilidades->get_result();
$habilidades = $resultHabilidades->fetch_all(MYSQLI_ASSOC);

$sqlIdiomas = "SELECT * FROM curriculum_idioma JOIN idiomas ON curriculum_idioma.id_idioma = idiomas.id_idioma WHERE id_curriculum = ?";
$stmtIdiomas = $conn->prepare($sqlIdiomas);
$stmtIdiomas->bind_param("i", $curriculum['id_curriculum']);
$stmtIdiomas->execute();
$resultIdiomas = $stmtIdiomas->get_result();
$idiomas = $resultIdiomas->fetch_all(MYSQLI_ASSOC);

$sqlRedes = "SELECT * FROM redes WHERE id_curriculum = ?";
$stmtRedes = $conn->prepare($sqlRedes);
$stmtRedes->bind_param("i", $curriculum['id_curriculum']);
$stmtRedes->execute();
$resultRedes = $stmtRedes->get_result();
$redes = $resultRedes->fetch_all(MYSQLI_ASSOC);

$sqlReferencias = "SELECT * FROM referencias WHERE id_curriculum = ?";
$stmtReferencias = $conn->prepare($sqlReferencias);
$stmtReferencias->bind_param("i", $curriculum['id_curriculum']);
$stmtReferencias->execute();
$resultReferencias = $stmtReferencias->get_result();
$referencias = $resultReferencias->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Currículum Digital</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<?php include '../componentes/navbar.php'; ?>
<div class="container mt-5">
  <h2>Editar Currículum Digital</h2>
  <form action="guardar_cv.php" method="POST">

    <!-- Información básica del candidato -->
    <div class="mb-3">
      <label for="nombre" class="form-label">Nombre</label>
      <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($curriculum['nombre'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label for="apellido" class="form-label">Apellido</label>
      <input type="text" class="form-control" id="apellido" name="apellido" value="<?= htmlspecialchars($curriculum['apellido'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label for="correo" class="form-label">Correo Electrónico</label>
      <input type="email" class="form-control" id="correo" name="correo" value="<?= htmlspecialchars($curriculum['correo'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label for="telefono" class="form-label">Teléfono</label>
      <input type="text" class="form-control" id="telefono" name="telefono" value="<?= htmlspecialchars($curriculum['telefono'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label for="direccion" class="form-label">Dirección</label>
      <input type="text" class="form-control" id="direccion" name="direccion" value="<?= htmlspecialchars($curriculum['direccion'] ?? '') ?>" required>
    </div>

    <div class="mb-3">
      <label for="ciudad" class="form-label">Ciudad</label>
      <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?= htmlspecialchars($curriculum['ciudad'] ?? '') ?>" required>
    </div>

    <!-- Nuevo campo: Objetivo Profesional -->
    <div class="mb-3">
      <label for="objetivo_profesional" class="form-label">Objetivo Profesional</label>
      <textarea class="form-control" id="objetivo_profesional" name="objetivo_profesional" rows="3"><?= htmlspecialchars($curriculum['objetivo_profesional'] ?? '') ?></textarea>
    </div>

    <!-- Nuevo campo: Disponibilidad -->
    <div class="mb-3">
      <label for="disponibilidad" class="form-label">Disponibilidad</label>
      <input type="text" class="form-control" id="disponibilidad" name="disponibilidad" value="<?= htmlspecialchars($curriculum['disponibilidad'] ?? '') ?>" required>
    </div>

    <!-- Formación Académica -->
    <h4>Formación Académica</h4>
    <?php foreach ($formaciones as $formacion): ?>
      <div class="mb-3">
        <label for="institucion" class="form-label">Institución</label>
        <input type="text" class="form-control" name="institucion[]" value="<?= htmlspecialchars($formacion['institucion']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="titulo" class="form-label">Título</label>
        <input type="text" class="form-control" name="titulo[]" value="<?= htmlspecialchars($formacion['titulo']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
        <input type="date" class="form-control" name="fecha_inicio[]" value="<?= htmlspecialchars($formacion['fecha_inicio']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="fecha_fin" class="form-label">Fecha de Fin</label>
        <input type="date" class="form-control" name="fecha_fin[]" value="<?= htmlspecialchars($formacion['fecha_fin']) ?>" required>
      </div>
    <?php endforeach; ?>

    <!-- Experiencia Laboral -->
    <h4>Experiencia Laboral</h4>
    <?php foreach ($experiencias as $experiencia): ?>
      <div class="mb-3">
        <label for="empresa" class="form-label">Empresa</label>
        <input type="text" class="form-control" name="empresa[]" value="<?= htmlspecialchars($experiencia['empresa']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="puesto" class="form-label">Puesto</label>
        <input type="text" class="form-control" name="puesto[]" value="<?= htmlspecialchars($experiencia['puesto']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="fecha_inicio_exp" class="form-label">Fecha de Inicio</label>
        <input type="date" class="form-control" name="fecha_inicio_exp[]" value="<?= htmlspecialchars($experiencia['fecha_inicio']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="fecha_fin_exp" class="form-label">Fecha de Fin</label>
        <input type="date" class="form-control" name="fecha_fin_exp[]" value="<?= htmlspecialchars($experiencia['fecha_fin']) ?>" required>
      </div>
    <?php endforeach; ?>

    <!-- Habilidades -->
    <h4>Habilidades</h4>
    <?php foreach ($habilidades as $habilidad): ?>
      <div class="mb-3">
        <input type="text" class="form-control" name="habilidad[]" value="<?= htmlspecialchars($habilidad['nombre']) ?>" required>
      </div>
    <?php endforeach; ?>

    <!-- Idiomas -->
    <h4>Idiomas</h4>
    <?php foreach ($idiomas as $idioma): ?>
      <div class="mb-3">
        <input type="text" class="form-control" name="idioma[]" value="<?= htmlspecialchars($idioma['nombre']) ?>" required>
      </div>
    <?php endforeach; ?>

    <!-- Referencias -->
    <h4>Referencias</h4>
    <?php foreach ($referencias as $referencia): ?>
      <div class="mb-3">
        <label for="nombre_referencia" class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre_referencia[]" value="<?= htmlspecialchars($referencia['nombre']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="descripcion_referencia" class="form-label">Descripción</label>
        <textarea class="form-control" name="descripcion_referencia[]" required><?= htmlspecialchars($referencia['descripcion']) ?></textarea>
      </div>
    <?php endforeach; ?>

    <!-- Redes Profesionales -->
    <h4>Redes Profesionales</h4>
    <?php foreach ($redes as $red): ?>
      <div class="mb-3">
        <label for="tipo_red" class="form-label">Tipo</label>
        <input type="text" class="form-control" name="tipo_red[]" value="<?= htmlspecialchars($red['tipo']) ?>" required>
      </div>
      <div class="mb-3">
        <label for="url_red" class="form-label">URL</label>
        <input type="url" class="form-control" name="url_red[]" value="<?= htmlspecialchars($red['url']) ?>" required>
      </div>
    <?php endforeach; ?>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
  </form>
</div>

<?php include '../componentes/footer.php'; ?>
</body>
</html>
