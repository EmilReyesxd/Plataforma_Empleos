<!DOCTYPE html>
<html lang="es">
<head><meta charset="UTF-8"><title>Registro Empresa</title>
<link rel="stylesheet" href="../../assets/css/style.css"></head>
<body>
<h2>Registro Empresa</h2>
<form method="POST" action="../../controllers/AuthController.php">
  <input type="hidden" name="tipo" value="empresa">
  <input name="nombre" placeholder="Nombre empresa" required>
  <input type="email" name="correo" placeholder="Correo" required>
  <input type="password" name="contraseña" placeholder="Contraseña" required>
  <input name="direccion" placeholder="Dirección" required>
  <button>Registrar</button>
</form>
<a href="login.php">¿Ya tienes cuenta?</a>
</body>
</html>
