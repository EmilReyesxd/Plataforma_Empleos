<?php
class Candidato {
    public function registrar($data, $files) {
        global $conexion;

        $nombre = $data['nombre'];
        $apellido = $data['apellido'];
        $correo = $data['correo'];
        $contraseña = password_hash($data['contraseña'], PASSWORD_DEFAULT);
        $telefono = $data['telefono'];
        $direccion = $data['direccion'];
        $ciudad = $data['ciudad'];
        $foto = null;
        $cv_pdf = null;

        // Subir imagen
        if (isset($files['foto']['tmp_name']) && !empty($files['foto']['tmp_name'])) {
            $foto = 'uploads/' . time() . '_' . basename($files['foto']['name']);
            move_uploaded_file($files['foto']['tmp_name'], '../' . $foto);
        }

        // Subir PDF
        if (isset($files['cv_pdf']['tmp_name']) && !empty($files['cv_pdf']['tmp_name'])) {
            $cv_pdf = 'uploads/' . time() . '_' . basename($files['cv_pdf']['name']);
            move_uploaded_file($files['cv_pdf']['tmp_name'], '../' . $cv_pdf);
        }

        $sql = "INSERT INTO candidatos (nombre, apellido, correo, contraseña, telefono, direccion, ciudad, foto, cv_pdf) 
                VALUES ('$nombre', '$apellido', '$correo', '$contraseña', '$telefono', '$direccion', '$ciudad', '$foto', '$cv_pdf')";
        if ($conexion->query($sql)) {
            header("Location: ../vistas/login.php?registro=ok");
        } else {
            echo "Error al registrar candidato: " . $conexion->error;
        }
    }

    public function login($data) {
        global $conexion;

        $correo = $data['correo'];
        $contraseña = $data['contraseña'];

        $sql = "SELECT * FROM candidatos WHERE correo = '$correo'";
        $res = $conexion->query($sql);
        if ($res->num_rows > 0) {
            $candidato = $res->fetch_assoc();
            if (password_verify($contraseña, $candidato['contraseña'])) {
                $_SESSION['candidato'] = $candidato;
                header("Location: ../vistas/candidato/inicio.php");
                exit;
            }
        }
        header("Location: ../vistas/login.php?error=1");
    }
}
?>
