<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <link rel="icon" type="thundrbike/png" href="img/thunderbike.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://wallpaperaccess.com/full/5651708.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            margin: auto;
            width: 80%;
            max-width: 800px;
            border-radius: 10px;
            position: relative; /* Añadido */
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .button-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .button-container .button {
            margin-left: auto;
        }

        .button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #45a049;
        }

        .button-edit {
            background-color: #008CBA;
        }

        .button-delete {
            background-color: #f44336;
        }

        #formContainer {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            position: fixed; /* Cambiado a posición fija */
            top: 50%; /* Centrado verticalmente */
            left: 50%; /* Centrado horizontalmente */
            transform: translate(-50%, -50%); /* Centrado exacto */
            display: none;
        }

        #formTitle {
            margin-top: 0;
        }

        #clientForm input {
            width: calc(100% - 22px); /* Se resta el ancho del padding */
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        #clientForm button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #clientForm button:hover {
            background-color: #45a049;
        }

        .home-button-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

    </style>
</head>
<body>
    
    <div class="container">
        <h1>Listado de Clientes</h1>
        <div class="button-container">
            <button class="button" onclick="showAddForm()">Agregar Cliente</button>
        </div>
        <table id="clientes">
            <!-- Cabecera de la tabla -->
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th> <!-- Nueva columna para botones de editar y borrar -->
            </tr>
            <!-- Datos de los clientes -->
            <?php
            include "controladores/conexion.php";
            ?> 
        </table>
       
        <div id="formContainer">
            <h2 id="formTitle">Agregar Cliente</h2>
            <form id="clientForm" method="post">
                <input type="hidden" id="clientId" name="clientId">
                <input type="text" id="clientName" name="clientName" placeholder="Nombre" required>
                <input type="text" id="clientAddress" name="clientAddress" placeholder="Dirección" required>
                <input type="text" id="clientPhone" name="clientPhone" placeholder="Teléfono" required>
                <button type="submit">Guardar</button>
                <button type="button" onclick="cancelForm()">Cancelar</button>
            </form>
        </div>
    </div>

    <div class="home-button-container">
        <button class="button" onclick="goToHome()">Inicio</button>
    </div>

    <script>
        function showAddForm() {
            document.getElementById('formTitle').innerText = 'Agregar Cliente';
            document.getElementById('clientForm').reset();
            document.getElementById('formContainer').style.display = 'block';
        }

        function showEditForm(cliente_Id, name, address, phone) {
            document.getElementById('formTitle').innerText = 'Editar Cliente';
            document.getElementById('clientForm').reset();
            document.getElementById('clientId').value = cliente_Id;
            document.getElementById('clientName').value = name;
            document.getElementById('clientAddress').value = address;
            document.getElementById('clientPhone').value = phone;
            document.getElementById('formContainer').style.display = 'block';
        }

        function cancelForm() {
            document.getElementById('formContainer').style.display = 'none';
        }

        function deleteClient(cliente_Id) {
            if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                    }
                };
                xhttp.open("POST", "controladores/save_client.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("action=delete&clientId=" + cliente_Id);
            }
        }

        function submitForm() {
            var cliente_Id = document.getElementById('clientId').value;
            var name = document.getElementById('clientName').value;
            var address = document.getElementById('clientAddress').value;
            var phone = document.getElementById('clientPhone').value;
            var action = cliente_Id ? 'edit' : 'add';

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4) {
                    if (this.status == 200) {
                        console.log(this.responseText);
                        location.reload();
                    } else {
                        console.error('Error en la solicitud AJAX');
                    }
                }
            };
            xhttp.open("POST", "controladores/save_client.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("action=" + action + "&clientId=" + cliente_Id + "&clientName=" + encodeURIComponent(name) + "&clientAddress=" + encodeURIComponent(address) + "&clientPhone=" + encodeURIComponent(phone));

            return false;
        }

        function goToHome() {
            window.location.href = "index.php";
        }
    </script>
    
</body>
</html>
