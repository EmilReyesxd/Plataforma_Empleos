<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Registro Candidato</title>
<link rel="stylesheet" href="../../assets/css/style.css"></head>
<body>
<h2>Registro Candidato</h2>
<form method="POST" action="../../controllers/AuthController.php">
  <input type="hidden" name="tipo" value="candidato">
  <input name="nombre" placeholder="Nombre" required>
  <input name="apellido" placeholder="Apellido" required>
  <input type="email" name="correo" placeholder="Correo" required>
  <input type="password" name="contraseña" placeholder="Contraseña" required>
  <button>Registrarse</button>
</form>
<a href="login.php">¿Ya tienes cuenta?</a>
</body>
</html>
