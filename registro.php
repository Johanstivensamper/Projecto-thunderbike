<?php include('servidor.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>Registro</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" type="thundrbike/png" href="img/thunderbike.png">
</head>
<body>
  <div class="header">
  	<h2>Registro Thunderbike</h2>
  </div>
	
  <form method="post" action="registro.php">
  	<?php include('errores.php'); ?>
  	<div class="input-group">
  	  <label>Nombre Usuario</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Correo</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirmar password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <label>Seleccione Cargo a ejercer:</label>
  	  <select name="role">
  	    <option value="vendedor">Vendedor</option>
  	    <option value="mecanico">Mecanico</option>
  	  </select>
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="reg_user">Registrar</button>
  	</div>
  	<p>
      ¿Ya eres usuario? <a href="logeo.php">Iniciar sesión</a>
  	</p>
  </form>
  <footer>
    <center>&copy; 2024 THUNDERBIKE. Todos los derechos reservados.</center>
  </footer>
</body>
</html>
