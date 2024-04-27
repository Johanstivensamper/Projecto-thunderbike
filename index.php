<?php 
session_start(); 

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Debes iniciar sesión primero";
    header('location: logeo.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: logeo.php");
}

// Obtener el rol del usuario desde la sesión
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

?>
<!DOCTYPE html>
<html>
<head>
    <title>THUNDERBIKE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="thundrbike/png" href="img/thunderbike.png">
    <!-- http://localhost/registrocdm1/index.php -->
</head>
<body>
<!--style="color: red;" -->
<nav class="navtop">
    <div>
    <img src="img/thunderbike.png" alt="thunderbike" style="width: 55px; height: 55px;">
        <h1>THUNDERBIKE</h1>
        <a href="index.php"><i class="fas fa-user-circle"></i>Perfil</a>
        <div class="container">
        <div class="button-container">
            <a href="cli.php" class="button">Clientes</a>
            <a href="productos.php" class="button">Productos</a>
            <a href="ventas.php" class="button">Ventas</a>
            <a href="proveedores.php" class="button">Proveedores</a>
            <a href="reparaciones.php" class="button">Reparaciones</a>
            <a href="inicio.php?logout='1'">Cerrar Sesion</a>
        </div>
    </div>
    </div>
</nav>
<!--style="color: red;" -->
<div class="header">
    <h2>BIENVENIDOS</h2>
</div>
<div class="content">
    <!-- mensaje de notificación -->
    <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success" >
            <h3>
                <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
                ?>
            </h3>
        </div>
    <?php endif ?>

    <!-- información del usuario registrado -->
    <?php  if (isset($_SESSION['username'])) : ?>
        <p>Bienvenido <strong><?php echo $_SESSION['username']; ?></strong></p>
        <?php if($role === 'administrador') : ?>
            <p>Este es el panel de administrador</p>
            <!-- Coloca aquí el contenido específico para el rol de administrador -->
        <?php elseif($role === 'mecanico') : ?>
            <p>Este es el panel de mecanico</p>
            <!-- Coloca aquí el contenido específico para el rol de empleado -->
			<?php elseif($role === 'vendedor') : ?>
            <p>Este es el panel de vendedor</p>
        <?php endif ?>
    <?php endif ?>
</div>

</body>
</html>
