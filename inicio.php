<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('location: logeo.php');
    exit();
}

$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>THUNDERBIKE</title>
    <link rel="icon" type="image/png" href="img/thunderbikes.png">
    <style>
        /* Normalización de márgenes y padding */
        * {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-size: 120%;
            background: #f5f5f5;
        }

        .header {
            width: 60%;
            margin: 40px auto 0px;
            color: white;
            background: #5F9EA0;
            text-align: center;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 0px 0px;
            padding: 20px;
        }

        form, .content {
            width: 70%;
            margin: 0px auto;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 10px 0px 10px 10px;
        }

        .input-group {
            margin: 10px 0px 10px 0px;
        }

        .input-group label {
            display: block;
            text-align: left;
            margin: 3px;
        }

        .input-group input {
            height: 30px;
            width: 93%;
            padding: 5px 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid gray;
        }

        .btn {
            padding: 10px;
            font-size: 15px;
            color: rgb(12, 12, 12);
            background: #ffc600;
            border: none;
            border-radius: 5px;
        }

        .error {
            width: 92%; 
            margin: 0px auto; 
            padding: 10px; 
            border: 1px solid #a94442; 
            color: #a94442; 
            background: #f2dede; 
            border-radius: 5px; 
            text-align: left;
        }

        .success {
            color: #3c763d; 
            background: #dff0d8; 
            border: 1px solid #3c763d;
            margin-bottom: 20px;
        }

        .navtop {
            background-color: #2f3947;
            height: 60px;
            width: 100%;
            border: 0;
        }

        .navtop div {
            display: flex;
            margin: 0 auto;
            width: 1000px;
            height: 100%;
        }

        .navtop div h1, .navtop div a {
            display: inline-flex;
            align-items: center;
        }

        .navtop div h1 {
            flex: 1;
            font-size: 24px;
            padding: 0;
            margin: 0;
            color: #eaebed;
            font-weight: normal;
        }

        .navtop div a {
            padding: 0 20px;
            text-decoration: none;
            color: #c1c4c8;
            font-weight: bold;
        }

        .navtop div a:hover {
            color: #eaebed;
        }

        /* Estilo para el botón seleccionado */
        .button-selected {
            background-color: gold;
        }

        /* Estilo para el botón al pasar el mouse sobre él */
        .button:hover {
            background-color: lightblue;
        }

        /* Estilo para cambiar el color del texto del botón "Cerrar Sesión" al pasar el mouse sobre él */
        #cerrarSesionBtn:hover {
            color: red;
        }

        /* Estilo para el video de fondo */
        #background-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            object-fit: cover;
        }
    </style>
</head>
<body>
<nav class="navtop">
    <div>
        <img src="img/thunderbikes.png" alt="thunderbikes" style="width: 55px; height: 55px;">
        <h1>THUNDERBIKE</h1>
        <div class="container">
            <div class="button-container">
                <a href="perfil.php" id="perfilBtn" class="button">Perfil</a>
                
                <!-- Opciones para el administrador -->
                <?php if ($role == 'administrador'): ?>
                    <a href="clientes.php" id="clientesBtn" class="button">Clientes</a>
                    <a href="productos.php" id="productosBtn" class="button">Productos</a>
                    <a href="proveedores.php" id="proveedoresBtn" class="button">Proveedores</a>
                    <a href="ventas.php" id="ventasBtn" class="button">Ventas</a>
                    <a href="reparaciones.php" id="reparacionesBtn" class="button">Reparaciones</a>
                <?php endif; ?>
                
                <!-- Opciones para el vendedor (sin productos repetidos) -->
                <?php if ($role == 'vendedor'): ?>
                    <a href="ventas.php" id="ventasBtn" class="button">Ventas</a>
                <?php endif; ?>

                <!-- Opciones para el mecánico -->
                <?php if ($role == 'mecanico'): ?>
                    <a href="reparaciones.php" id="reparacionesBtn" class="button">Reparaciones</a>
                <?php endif; ?>

                <a href="index.php?logout='1'" id="cerrarSesionBtn" class="button special">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</nav>

<div>
    <?php if ($role == 'administrador'): ?>
        <h1 style="color: gold;">Bienvenido al Panel de Administrador</h1>
        <p style="color: gold;">Esta es una página exclusiva para administradores.</p>
    <?php elseif ($role == 'mecanico'): ?>
        <h1 style="color: gold;">Bienvenido al Panel de Mecánico</h1>
        <p style="color: gold;">Esta es una página exclusiva para mecánicos.</p>
    <?php elseif ($role == 'vendedor'): ?>
        <h1 style="color: gold;">Bienvenido al Panel de Vendedor</h1>
        <p style="color: gold;">Esta es una página exclusiva para vendedores.</p>
    <?php endif; ?>
</div>

<video id="background-video" autoplay muted loop>
    <source src="img/salto2.mp4" type="video/mp4">
    Tu navegador no admite la etiqueta de video.
</video>

<!-- mensaje de notificación -->
<?php if (isset($_SESSION['success'])) : ?>
    <div class="error success">
        <h3>
            <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
            ?>
        </h3>
    </div>
<?php endif; ?>

<!-- información del usuario registrado -->
<?php if (isset($_SESSION['username'])) : ?>
    <p><strong style="font-size: 24px; color: #efb810;"><?php echo $_SESSION['username']; ?></strong></p>
<?php endif; ?>

<script>
    // Selecciona el botón "Cerrar Sesión"
    const logoutButton = document.getElementById('cerrarSesionBtn');

    // Agrega un listener de eventos cuando el mouse entra al botón
    logoutButton.addEventListener('mouseenter', () => {
        logoutButton.style.color = 'red';
    });

    // Agrega un listener de eventos cuando el mouse sale del botón
    logoutButton.addEventListener('mouseleave', () => {
        logoutButton.style.color = 'white';
    });
</script>

<script>
    var buttons = document.querySelectorAll('.button');

    buttons.forEach(function(button) {
        button.addEventListener('click', function() {
            buttons.forEach(function(btn) {
                btn.classList.remove('button-selected');
            });
            button.classList.add('button-selected');
        });
    });
</script>

</body>
</html>
