<?php
require_once '../config/db.php';
require_once '../helpers/session.php';
session_start();
if (!isCandidato()) header("Location: ../views/auth/login.php");

if ($_POST['accion'] === 'aplicar') {
    $id_can = $_SESSION['usuario'];
    $id_of  = (int)$_POST['id_oferta'];
    $conn->query("INSERT INTO aplicaciones (id_oferta,id_candidato) VALUES ($id_of,$id_can)");
    header("Location: ../views/candidatos/ver_ofertas.php?aplicado=ok");
    exit;
}
?>
