<?php
// Verificar si se recibió una acción
if (isset($_POST['action'])) {
    // Incluir archivo de conexión a la base de datos
    include "controladores/conexion.php";

    // Obtener la acción del formulario
    $action = $_POST['action'];

    // Realizar la acción correspondiente
    switch ($action) {
        case 'add':
            // Obtener datos del formulario
            $name = $_POST['clientName'];
            $address = $_POST['clientAddress'];
            $phone = $_POST['clientPhone'];

            // Insertar nuevo cliente en la base de datos
            $sql = "INSERT INTO clientes (id, nombre, direccion, telefono) VALUES ('$name', '$address', '$phone')";
            if ($conexion->query($sql) === TRUE) {
                echo "Cliente agregado exitosamente";
            } else {
                echo "Error al agregar cliente: " . $conexion->error;
            }
            break;

        case 'edit':
            // Obtener datos del formulario
            $clientId = $_POST['clientId'];
            $name = $_POST['clientName'];
            $address = $_POST['clientAddress'];
            $phone = $_POST['clientPhone'];

            // Actualizar cliente en la base de datos
            $sql = "UPDATE clientes SET nombre='$name', direccion='$address', telefono='$phone' WHERE id=$clientId";
            if ($conexion->query($sql) === TRUE) {
                echo "Cliente actualizado exitosamente";
            } else {
                echo "Error al actualizar cliente: " . $conexion->error;
            }
            break;

        case 'delete':
            // Obtener ID del cliente a eliminar
            $clientId = $_POST['clientId'];

            // Eliminar cliente de la base de datos
            $sql = "DELETE FROM clientes WHERE id=$clientId";
            if ($conexion->query($sql) === TRUE) {
                echo "Cliente eliminado exitosamente";
            } else {
                echo "Error al eliminar cliente: " . $conexion->error;
            }
            break;

        default:
            echo "Acción no válida";
            break;
    }

    // Cerrar conexión a la base de datos
    $conexion->close();
} else {
    echo "No se recibió ninguna acción";
}
?>


