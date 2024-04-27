<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Panel de Administrador</title>
  <style>
    /* Estilos CSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      color: #333;
      line-height: 1.6;
      padding: 20px;
    }
    .container {
      max-width: 800px;
      margin: auto;
      overflow: hidden;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h2 {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
    }
    input[type="text"],
    input[type="number"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"] {
      background: #333;
      color: #fff;
      border: none;
      padding: 10px 20px;
      cursor: pointer;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Panel de Administrador</h2>
    <form id="formulario">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" required>
      <label for="descripcion">Descripción:</label>
      <input type="text" id="descripcion" name="descripcion" required>
      <label for="precio">Precio:</label>
      <input type="number" id="precio" name="precio" min="0" step="0.01" required>
      <input type="submit" value="Agregar Producto">
    </form>
    <h2>Lista de Productos</h2>
    <table id="lista-productos">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <!-- Aquí se mostrarán los productos -->
      </tbody>
    </table>
  </div>

  <script>
    // Código JavaScript
    document.getElementById('formulario').addEventListener('submit', function(event) {
      event.preventDefault();
      var nombre = document.getElementById('nombre').value;
      var descripcion = document.getElementById('descripcion').value;
      var precio = document.getElementById('precio').value;

      // Aquí puedes enviar los datos del formulario al servidor para agregar el producto
      // Por ahora, solo mostraremos los datos en la tabla de productos
      var tbody = document.querySelector('#lista-productos tbody');
      var newRow = tbody.insertRow();
      newRow.innerHTML = `<td>${nombre}</td><td>${descripcion}</td><td>${precio}</td>`;
    });
  </script>
</body>
</html>
