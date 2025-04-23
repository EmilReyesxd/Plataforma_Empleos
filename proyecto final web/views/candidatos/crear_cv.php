<?php
require_once '../../helpers/session.php';
require_once '../../config/db.php';

if (!isCandidato()) header("Location: ../auth/login.php");

$idCandidato = $_SESSION['usuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $objetivo = $_POST['objetivo'];
    $disponibilidad = $_POST['disponibilidad'];

    $sql = "INSERT INTO curriculum (id_candidato, objetivo_profesional, disponibilidad) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $idCandidato, $objetivo, $disponibilidad);
    $stmt->execute();

    $idCurriculum = $conn->insert_id;

    // Redireccionar a editar para que complete más secciones
    header("Location: editar_cv.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
<?php include '../componentes/navbar.php'; ?>
<div class="container mt-4">
    <h2>Crear Currículum Digital</h2>
    <form method="POST">
        <!-- 1. Objetivo Profesional -->
        <div class="mb-3">
            <label for="objetivo" class="form-label">Objetivo Profesional / Resumen</label>
            <textarea name="objetivo" id="objetivo" class="form-control" required></textarea>
        </div>

        <!-- 2. Disponibilidad -->
        <div class="mb-3">
            <label for="disponibilidad" class="form-label">Disponibilidad</label>
            <select name="disponibilidad" id="disponibilidad" class="form-control" required>
                <option value="Inmediata">Inmediata</option>
                <option value="En 15 días">En 15 días</option>
                <option value="En 30 días">En 30 días</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Guardar y continuar</button>
    </form>
</div>
<?php include '../componentes/footer.php'; ?>
</body>
</html>
