<?php
// CONTROLADORES/conexion.php

// Datos de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "thunderbike";

// Crear conexión
$conexion = new mysqli($host, $user, $password, $database);

// Verificar conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Consulta SQL para obtener los clientes
$sql = "SELECT id, nombre, direccion, telefono FROM clientes";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Mostrar datos de cada cliente en la tabla
    while($fila = $resultado->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . $fila["nombre"] . "</td>";
        echo "<td>" . $fila["direccion"] . "</td>";
        echo "<td>" . $fila["telefono"] . "</td>";
        echo "<td>";
        echo "<button class='button button-edit' onclick='showEditForm(" . $fila["id"] . ", \"" . $fila["nombre"] . "\", \"" . $fila["direccion"] . "\", \"" . $fila["telefono"] . "\")'>Editar</button>";
        echo "<button class='button button-delete' onclick='deleteClient(" . $fila["id"] . ")'>Eliminar</button>";
        echo "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay clientes</td></tr>";
}

// Cerrar conexión
$conexion->close();
?>
