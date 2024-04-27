<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reparaciones Realizadas</title>
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
  <a href="index.php" class="btn btn-primary btn-home float-right">Inicio</a>
    <h2>Reparaciones Realizadas</h2>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Cliente ID</th>
          <th>Producto ID</th>
          <th>Descripción</th>
          <th>Costo</th>
          <th>Fecha de Reparación</th>
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

          // Consulta SQL para obtener las reparaciones realizadas
          $sql = "SELECT * FROM reparaciones";
          $result = $mysqli->query($sql);

          // Mostrar las reparaciones realizadas en la tabla
          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["id"] . "</td><td>" . $row["cliente_id"] ."</td><td>". $row["producto_id"] . "</td><td>" . $row["descripcion"] . "</td><td>". $row["costo"] . "</td><td>". $row["fecha_reparacion"] . "</td></tr>";
              }
          } else {
              echo "<tr><td colspan='6'>No se encontraron reparaciones realizadas</td></tr>";
          }

          // Cerrar la conexión a la base de datos
          $mysqli->close();
        ?>
      </tbody>
    </table>
    <a href="agregar_reparacion.php" class="btn">Agregar Reparación</a>
  </div>
</body>
</html>
