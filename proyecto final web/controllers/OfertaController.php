<?php
require_once '../config/db.php';
require_once '../helpers/session.php';

if (!isEmpresa()) header("Location: ../views/auth/login.php");
$id_emp = $_SESSION['usuario'];

if ($_POST['accion'] === 'crear_oferta') {
    $t = $conn->real_escape_string($_POST['titulo']);
    $d = $conn->real_escape_string($_POST['descripcion']);
    $r = $conn->real_escape_string($_POST['requisitos']);
    $conn->query("INSERT INTO ofertas (id_empresa,titulo,descripcion,requisitos)
                  VALUES ($id_emp,'$t','$d','$r')");
    header("Location: ../views/empresas/dashboard.php");
    exit;
}
if ($_POST['accion'] === 'editar_oferta') {
    $id = (int)$_POST['id_oferta'];
    $t  = $conn->real_escape_string($_POST['titulo']);
    $d  = $conn->real_escape_string($_POST['descripcion']);
    $r  = $conn->real_escape_string($_POST['requisitos']);
    $conn->query("UPDATE ofertas SET titulo='$t',descripcion='$d',requisitos='$r'
                  WHERE id_oferta=$id AND id_empresa=$id_emp");
    header("Location: ../views/empresas/dashboard.php");
    exit;
}
if ($_POST['accion'] === 'eliminar_oferta') {
    $id = (int)$_POST['id_oferta'];
    $conn->query("DELETE FROM ofertas WHERE id_oferta=$id AND id_empresa=$id_emp");
    header("Location: ../views/empresas/dashboard.php");
    exit;
}
?>
