<?php include('servidor.php') ?>
<!DOCTYPE html>
<html>
<head>
  <title>INICIAR SESION</title>
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="icon" type="thundrbike/png" href="img/thunderbike.png">
  <style>
    .volver-btn {
        position: absolute;
        top: 20px;
        right: 20px;
    }
  </style>
</head>
<body>
	<div class="input-group">
      <button onclick="window.location.href='inicio.php'" class="btn" type="button">Volver al Inicio</button>
    </div>
  <div class="header">
	<img src="img/thunderbike.png" alt="thunderbike" style="width: 190px; height: 190px;">
  <h2 class="animate__animated animate__bounce">INICIAR SESION</h2>
  </div>
	 
  <form method="post" action="logeo.php">
  	<?php include('errores.php'); ?>
  	<div class="input-group">
  		<label>Nombre Usuario: </label>
  		<input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		<label>Clave: </label>
  		<input type="password" name="password">
  	</div>
  	<!-- Agregar el menú de rol aquí -->
  	<div class="input-group">
  	  <label>Cargo:</label>
  	  <select name="role">
  	    <option value="administrador">Administrador</option>
  	    <option value="mecanico">Mecanico</option>
		<option value="vendedor">Vendedor</option>
  	  </select>
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login_user">INICIAR</button>
  	</div>
  	<p>
      ¿Todavía no eres miembro? <a href="registro.php">REGISTRATE</a>
  	</p>
  </form>
  <footer>
    <center>V1.0.1 © Todos los derechos reservados. Thunderbike</center>
  </footer>
</body>
</html>