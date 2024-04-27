<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ventas Realizadas</title>
  <style>
    /* Estilos CSS */
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
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }
    h2 {
      margin-bottom: 20px;
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
    .btn {
      background-color: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Ventas Realizadas</h2>
    <table>
      <thead>
        <tr>
          <th>Comprador</th>
          <th>Fecha</th>
          <th>Producto</th>
          <th>Caracteristicas</th>
          <th>Valor Total</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Conexión a la base de datos
          $mysqli = new mysqli("localhost", "root", "", "thunderbike");

          // Verificar la conexión
          if ($mysqli->connect_error) {
              die("Error de conexión: " . $mysqli->connect_error);
          }

          // Consulta SQL para obtener las ventas realizadas
          $sql = "SELECT * FROM ventas";
          $result = $mysqli->query($sql);

          // Mostrar las ventas realizadas en la tabla
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                  echo "<tr><td>" . $row["cliente_id"] . "</td><td>" . $row["fecha_venta"] ."</td><td>". $row["producto_vendido_id"] . "</td><td>" . $row["descripcion_venta"] . "</td><td>". $row["total"]; 
              }
          } else {
              echo "<tr><td colspan='4'>No se encontraron ventas realizadas</td></tr>";
          }

          // Cerrar la conexión a la base de datos
          $mysqli->close();
        ?>
      </tbody>
    </table>
    <a href="agregar_venta.php" class="btn">Agregar Venta</a>
  </div>
</body>
</html>
