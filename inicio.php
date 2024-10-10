<?php
session_start();

// Configurar headers para evitar cache
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

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
            margin: 0;
            padding: 0;
        }

        body {
            font-size: 120%;
            background: #f5f5f5;
        }

        .header {
            width: 60%;
            margin: 40px auto 0;
            color: white;
            background: #5F9EA0;
            text-align: center;
            border: 1px solid #B0C4DE;
            border-bottom: none;
            border-radius: 10px 10px 0 0;
            padding: 20px;
        }

        form, .content {
            width: 70%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #B0C4DE;
            background: white;
            border-radius: 10px 0 10px 10px;
        }

        .input-group {
            margin: 10px 0;
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
            margin: 0 auto; 
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
            color: #eaebed;
            font-weight: normal;
        }

        .navtop div a {
            padding: 0 20px;
            text-decoration: none;
            color: #E5A65E;
            font-weight: bold;
            position: relative;
        }

        .tooltip {
            display: none; 
            position: absolute;
            background-color: white;
            border: 1px solid #B0C4DE;
            padding: 2px 5px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            z-index: 100;
            top: 6%;
            left: 50%;
            transform: translateX(-61%);
            white-space: nowrap;
            max-width: 150px;
            max-height: 50px;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .tooltip a {
            color: black;
            text-decoration: none;
        }

        .tooltip a:hover {
            color: #007BFF;
        }

        .navtop div a:hover {
            color: #eaebed;
        }

        .button-selected {
            background-color: gold;
        }

        .button:hover {
            background-color: lightblue;
        }

        #cerrarSesionBtn:hover {
            color: red;
        }

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
                
                <?php if ($role == 'administrador'): ?>
                    <a href="clientes.php" id="clientesBtn" class="button">Clientes</a>
                    <a href="productos.php" id="productosBtn" class="button">Productos</a>
                    <div class="tooltip" id="productosTooltip">
                        <a href="bicicletas.php" class="dropdown-item">Bicicletas</a><br>
                        <a href="accesorios.php" class="dropdown-item">Accesorios</a>
                    </div>
                    <a href="proveedores.php" id="proveedoresBtn" class="button">Proveedores</a>
                    <a href="ventas.php" id="ventasBtn" class="button">Ventas</a>
                    <a href="reparaciones.php" id="reparacionesBtn" class="button">Reparaciones</a>
                <?php elseif ($role == 'vendedor'): ?>
                    <a href="ventas.php" id="ventasBtn" class="button">Ventas</a>
                <?php elseif ($role == 'mecanico'): ?>
                    <a href="reparaciones.php" id="reparacionesBtn" class="button">Reparaciones</a>
                <?php endif; ?>

                <a href="logout.php" id="cerrarSesionBtn" class="button special">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</nav>

<div>
    <h1 style="color: gold;">Bienvenido al Panel de <?= ucfirst($role) ?></h1>
    <p style="color: gold;">Esta es una página exclusiva para <?= $role === 'administrador' ? 'administradores' : ($role === 'mecanico' ? 'mecánicos' : 'vendedores') ?>.</p>
</div>

<video id="background-video" autoplay muted loop>
    <source src="img/salto2.mp4" type="video/mp4">
    Tu navegador no admite la etiqueta de video.
</video>

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

<?php if (isset($_SESSION['username'])) : ?>
    <p><strong style="font-size: 24px; color: #efb810;"><?php echo $_SESSION['username']; ?></strong></p>
<?php endif; ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verificar si hay un usuario activo
        const username = "<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>";
        
        if (!username) {
            // Redirigir si no hay sesión activa
            window.location.href = 'logeo.php';
        }

        const productosBtn = document.getElementById('productosBtn');
        const productosTooltip = document.getElementById('productosTooltip');

        // Mostrar tooltip
        productosBtn.addEventListener('mouseenter', () => {
            productosTooltip.style.display = 'block';
        });

        // Ocultar tooltip
        productosBtn.addEventListener('mouseleave', () => {
            productosTooltip.style.display = 'none';
        });

        // Mantener el tooltip visible al pasar el mouse sobre él
        productosTooltip.addEventListener('mouseenter', () => {
            productosTooltip.style.display = 'block';
        });

        productosTooltip.addEventListener('mouseleave', () => {
            productosTooltip.style.display = 'none';
        });

        // Cerrar sesión
        const logoutButton = document.getElementById('cerrarSesionBtn');
        logoutButton.addEventListener('mouseenter', () => {
            logoutButton.style.color = 'red';
        });
        logoutButton.addEventListener('mouseleave', () => {
            logoutButton.style.color = 'white';
        });

        // Selección de botones
        const buttons = document.querySelectorAll('.button');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                buttons.forEach(function(btn) {
                    btn.classList.remove('button-selected');
                });
                button.classList.add('button-selected');
            });
        });
    });
</script>

</body>
</html>
