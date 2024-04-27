<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="thundrbike/png" href="img/thunderbike.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('imagenes/bici.jpg'); /* Reemplaza 'bici.jpg' con la ruta de tu imagen de fondo */
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
            cursor: pointer;
        }

        .product:hover {
            background-color: #f9f9f9;
        }

        .product img {
            width: 80px;
            height: auto;
            margin-right: 20px;
        }

        .product-info {
            flex: 1;
        }

        .btn-home {
            margin-bottom: 20px;
        }

        .btn-action {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="index.php" class="btn btn-primary btn-home float-right">Inicio</a>
        <h1 class="text-center text-dark">Productos</h1>

        <?php
        // Establecer conexión a la base de datos
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "thunderbike";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        // Consultar productos
        $sql = "SELECT id, nombre, descripcion, precio FROM productos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="mt.jpg" alt="' . $row["nombre"] . '">';
                echo '<div class="product-info">';
                echo '<h3>' . $row["nombre"] . '</h3>';
                echo '<p>Descripción: ' . $row["descripcion"] . '</p>';
                echo '<p>Precio: $' . $row["precio"] . '</p>';
                echo '</div>';
                echo '<div>';
                echo '<button type="button" class="btn btn-info btn-action" onclick="editarProducto(' . $row["id"] . ', \'' . $row["nombre"] . '\', \'' . $row["descripcion"] . '\', \'' . $row["precio"] . '\')">Editar</button>';
                echo '<button type="button" class="btn btn-danger btn-action" onclick="eliminarProducto(' . $row["id"] . ')">Eliminar</button>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "No hay productos disponibles.";
        }
        $conn->close();
        ?>

        <button type="button" class="btn btn-success btn-action" data-toggle="modal" data-target="#agregarProductoModal">Agregar Producto</button>
    </div>

    <!-- Formulario emergente para editar producto -->
    <div class="modal fade" id="editarProductoModal" tabindex="-1" role="dialog" aria-labelledby="editarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editarProductoModalLabel">Editar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de edición de producto -->
                    <form action="editar_producto.php" method="post" id="editarProductoForm" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="editarProductoId">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="editarProductoNombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="editarProductoDescripcion" name="descripcion"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" class="form-control" id="editarProductoPrecio" name="precio">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" class="form-control-file" id="editarProductoImagen" name="imagen">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="submitEditarProductoForm()">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario emergente para agregar producto -->
    <div class="modal fade" id="agregarProductoModal" tabindex="-1" role="dialog" aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProductoModalLabel">Agregar Producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aquí va el formulario de agregar producto -->
                    <form action="agregar_producto.php" method="post" id="agregarProductoForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="agregarProductoNombre" name="nombre">
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción:</label>
                            <textarea class="form-control" id="agregarProductoDescripcion" name="descripcion"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio:</label>
                            <input type="number" class="form-control" id="agregarProductoPrecio" name="precio">
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" class="form-control-file" id="agregarProductoImagen" name="imagen">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary" onclick="submitAgregarProductoForm()">Agregar Producto</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editarProducto(id, nombre, descripcion, precio) {
            document.getElementById('editarProductoId').value = id;
            document.getElementById('editarProductoNombre').value = nombre;
            document.getElementById('editarProductoDescripcion').value = descripcion;
            document.getElementById('editarProductoPrecio').value = precio;
            $('#editarProductoModal').modal('show');
        }

        function submitEditarProductoForm() {
            document.getElementById('editarProductoForm').submit();
        }

        function submitAgregarProductoForm() {
            document.getElementById('agregarProductoForm').submit();
        }

        function eliminarProducto(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                $.ajax({
                    url: 'eliminar_producto.php',
                    type: 'POST',
                    data: {id: id},
                    success: function(response) {
                        alert("Producto eliminado correctamente");
                        window.location.reload();
                    },
                    error: function(xhr, status, error) {
                        alert("Error al eliminar el producto");
                    }
                });
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>