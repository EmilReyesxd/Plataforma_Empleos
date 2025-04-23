<?php
require_once '../config/db.php';
require_once '../helpers/session.php';
if (isset($_POST['login'])) {
    $correo = $_POST['correo'];
    $pass = $_POST['contraseña'];

    $sql = "SELECT id_candidato AS id, correo, contraseña, 'candidato' AS tipo FROM candidatos WHERE correo = ?
            UNION
            SELECT id_empresa AS id, correo, contraseña, 'empresa' AS tipo FROM empresas WHERE correo = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $correo, $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($user = $result->fetch_assoc()) {
        if (password_verify($pass, $user['contraseña'])) {
            $_SESSION['usuario'] = $user['id'];
            $_SESSION['correo'] = $user['correo'];
            $_SESSION['tipo'] = $user['tipo']; 

            header("Location: ../views/" . $user['tipo'] . "s/dashboard.php");
            exit;
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "Usuario no encontrado.";
    }
}
