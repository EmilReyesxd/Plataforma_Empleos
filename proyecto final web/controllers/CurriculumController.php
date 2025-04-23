<?php
require_once '../config/db.php';
require_once '../helpers/session.php';
session_start();
if (!isCandidato()) header("Location: ../views/auth/login.php");

$id_candidato = $_SESSION['usuario'];

if ($_POST['accion'] === 'guardar_curriculum') {
    // Insertar curriculum
    $objetivo = $conn->real_escape_string($_POST['objetivo_profesional']);
    $disp     = $conn->real_escape_string($_POST['disponibilidad']);
    $conn->query("INSERT INTO curriculum (id_candidato, objetivo_profesional, disponibilidad)
                  VALUES ($id_candidato,'$objetivo','$disp')");
    $id_curr = $conn->insert_id;
    // Formaciones
    $conn->query("INSERT INTO formaciones (id_curriculum, institucion, titulo, fecha_inicio, fecha_fin)
                  VALUES ($id_curr,'{$_POST['institucion']}','{$_POST['titulo']}',
                  '{$_POST['fecha_inicio_formacion']}','{$_POST['fecha_fin_formacion']}')");
    // Experiencia
    $conn->query("INSERT INTO experiencias (id_curriculum, empresa, puesto, fecha_inicio, fecha_fin)
                  VALUES ($id_curr,'{$_POST['empresa']}','{$_POST['puesto']}',
                  '{$_POST['fecha_inicio_experiencia']}','{$_POST['fecha_fin_experiencia']}')");
    // Habilidades
    foreach($_POST['habilidades'] as $h) {
        $conn->query("INSERT INTO habilidades (nombre) VALUES ('$h')");
        $id_h = $conn->insert_id;
        $conn->query("INSERT INTO curriculum_habilidad VALUES ($id_curr,$id_h)");
    }
    // Idiomas
    foreach($_POST['idiomas'] as $i) {
        $conn->query("INSERT INTO idiomas (nombre) VALUES ('$i')");
        $id_i = $conn->insert_id;
        $conn->query("INSERT INTO curriculum_idioma VALUES ($id_curr,$id_i)");
    }
    // Logros, Referencias, Redes
    if (!empty($_POST['logros']))
        $conn->query("INSERT INTO referencias (id_curriculum,nombre,descripcion)
                      VALUES ($id_curr,'Logros','{$_POST['logros']}')");
    if (!empty($_POST['referencia']))
        $conn->query("INSERT INTO referencias (id_curriculum,nombre,descripcion)
                      VALUES ($id_curr,'Referencia','{$_POST['referencia']}')");
    if (!empty($_POST['red_url']))
        $conn->query("INSERT INTO redes (id_curriculum,tipo,url)
                      VALUES ($id_curr,'LinkedIn','{$_POST['red_url']}')");

    header("Location: ../views/candidatos/dashboard.php?cv=ok");
    exit;
}
?>
