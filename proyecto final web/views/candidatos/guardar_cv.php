<?php
require_once '../../helpers/session.php';
require_once '../../config/db.php';

if (!isCandidato()) {
    header("Location: ../auth/login.php");
    exit();
}

// Obtener el ID del candidato
$idCandidato = $_SESSION['usuario'];

// Verificar si se envió el ID del currículum
if (!isset($_POST['id_curriculum'])) {
    header("Location: dashboard.php");
    exit();
}

// Obtener los datos del currículum
$idCurriculum = $_POST['id_curriculum'];
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$ciudad = $_POST['ciudad'];

// Actualizar el currículum
$sql = "UPDATE curriculum SET nombre = ?, apellido = ?, correo = ?, telefono = ?, direccion = ?, ciudad = ? WHERE id_curriculum = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssi", $nombre, $apellido, $correo, $telefono, $direccion, $ciudad, $idCurriculum);
$stmt->execute();

// Actualizar las formaciones
if (isset($_POST['institucion'])) {
    $instituciones = $_POST['institucion'];
    $titulos = $_POST['titulo'];
    $fechasInicio = $_POST['fecha_inicio'];
    $fechasFin = $_POST['fecha_fin'];

    // Eliminar las formaciones previas
    $sqlEliminarFormaciones = "DELETE FROM formaciones WHERE id_curriculum = ?";
    $stmtEliminarFormaciones = $conn->prepare($sqlEliminarFormaciones);
    $stmtEliminarFormaciones->bind_param("i", $idCurriculum);
    $stmtEliminarFormaciones->execute();

    // Insertar las nuevas formaciones
    foreach ($instituciones as $index => $institucion) {
        $titulo = $titulos[$index];
        $fechaInicio = $fechasInicio[$index];
        $fechaFin = $fechasFin[$index];

        $sqlInsertarFormacion = "INSERT INTO formaciones (id_curriculum, institucion, titulo, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?, ?)";
        $stmtInsertarFormacion = $conn->prepare($sqlInsertarFormacion);
        $stmtInsertarFormacion->bind_param("issss", $idCurriculum, $institucion, $titulo, $fechaInicio, $fechaFin);
        $stmtInsertarFormacion->execute();
    }
}

// Actualizar las experiencias
if (isset($_POST['empresa'])) {
    $empresas = $_POST['empresa'];
    $puestos = $_POST['puesto'];
    $fechasInicioExp = $_POST['fecha_inicio_exp'];
    $fechasFinExp = $_POST['fecha_fin_exp'];

    // Eliminar las experiencias previas
    $sqlEliminarExperiencias = "DELETE FROM experiencias WHERE id_curriculum = ?";
    $stmtEliminarExperiencias = $conn->prepare($sqlEliminarExperiencias);
    $stmtEliminarExperiencias->bind_param("i", $idCurriculum);
    $stmtEliminarExperiencias->execute();

    // Insertar las nuevas experiencias
    foreach ($empresas as $index => $empresa) {
        $puesto = $puestos[$index];
        $fechaInicioExp = $fechasInicioExp[$index];
        $fechaFinExp = $fechasFinExp[$index];

        $sqlInsertarExperiencia = "INSERT INTO experiencias (id_curriculum, empresa, puesto, fecha_inicio, fecha_fin) VALUES (?, ?, ?, ?, ?)";
        $stmtInsertarExperiencia = $conn->prepare($sqlInsertarExperiencia);
        $stmtInsertarExperiencia->bind_param("issss", $idCurriculum, $empresa, $puesto, $fechaInicioExp, $fechaFinExp);
        $stmtInsertarExperiencia->execute();
    }
}

// Actualizar las habilidades
if (isset($_POST['habilidad'])) {
    $habilidades = $_POST['habilidad'];

    // Eliminar las habilidades previas
    $sqlEliminarHabilidades = "DELETE FROM curriculum_habilidad WHERE id_curriculum = ?";
    $stmtEliminarHabilidades = $conn->prepare($sqlEliminarHabilidades);
    $stmtEliminarHabilidades->bind_param("i", $idCurriculum);
    $stmtEliminarHabilidades->execute();

    // Insertar las nuevas habilidades
    foreach ($habilidades as $habilidad) {
        $sqlInsertarHabilidad = "INSERT INTO curriculum_habilidad (id_curriculum, id_habilidad) SELECT ?, id_habilidad FROM habilidades WHERE nombre = ?";
        $stmtInsertarHabilidad = $conn->prepare($sqlInsertarHabilidad);
        $stmtInsertarHabilidad->bind_param("is", $idCurriculum, $habilidad);
        $stmtInsertarHabilidad->execute();
    }
}

// Actualizar los idiomas
if (isset($_POST['idioma'])) {
    $idiomas = $_POST['idioma'];

    // Eliminar los idiomas previos
    $sqlEliminarIdiomas = "DELETE FROM curriculum_idioma WHERE id_curriculum = ?";
    $stmtEliminarIdiomas = $conn->prepare($sqlEliminarIdiomas);
    $stmtEliminarIdiomas->bind_param("i", $idCurriculum);
    $stmtEliminarIdiomas->execute();

    // Insertar los nuevos idiomas
    foreach ($idiomas as $idioma) {
        $sqlInsertarIdioma = "INSERT INTO curriculum_idioma (id_curriculum, id_idioma) SELECT ?, id_idioma FROM idiomas WHERE nombre = ?";
        $stmtInsertarIdioma = $conn->prepare($sqlInsertarIdioma);
        $stmtInsertarIdioma->bind_param("is", $idCurriculum, $idioma);
        $stmtInsertarIdioma->execute();
    }
}

// Redirigir a la página de perfil o dashboard
header("Location: dashboard.php");
exit();
?>
