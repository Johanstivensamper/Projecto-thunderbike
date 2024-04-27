<?php
include "conexion.php";

// Verifica si se ha enviado una solicitud POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si la acción es agregar un nuevo proveedor
    if ($_POST["action"] == "add") {
        // Recupera los datos del formulario
        $nombre = $_POST["proveedorName"];
        $direccion = $_POST["proveedorAddress"];
        $telefono = $_POST["proveedorPhone"];

        // Prepara la consulta SQL para insertar un nuevo proveedor
        $stmt = $conexion->prepare("INSERT INTO proveedores (nombre, direccion, telefono) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nombre, $direccion, $telefono);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "Proveedor agregado exitosamente.";
        } else {
            echo "Error al agregar el proveedor: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    } 
    // Verifica si la acción es editar un proveedor existente
    elseif ($_POST["action"] == "edit") {
        // Recupera los datos del formulario
        $proveedorId = $_POST["proveedorId"];
        $nombre = $_POST["proveedorName"];
        $direccion = $_POST["proveedorAddress"];
        $telefono = $_POST["proveedorPhone"];

        // Prepara la consulta SQL para actualizar el proveedor
        $stmt = $conexion->prepare("UPDATE proveedores SET nombre = ?, direccion = ?, telefono = ? WHERE id = ?");
        $stmt->bind_param("sssi", $nombre, $direccion, $telefono, $proveedorId);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "Proveedor actualizado exitosamente.";
        } else {
            echo "Error al actualizar el proveedor: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    } 
    // Verifica si la acción es eliminar un proveedor
    elseif ($_POST["action"] == "delete") {
        // Recupera el ID del proveedor a eliminar
        $proveedorId = $_POST["proveedorId"];

        // Prepara la consulta SQL para eliminar el proveedor
        $stmt = $conexion->prepare("DELETE FROM proveedores WHERE id = ?");
        $stmt->bind_param("i", $proveedorId);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "Proveedor eliminado exitosamente.";
        } else {
            echo "Error al eliminar el proveedor: " . $stmt->error;
        }

        // Cierra la declaración
        $stmt->close();
    }
}

// Cierra la conexión a la base de datos
$conexion->close();
?>
