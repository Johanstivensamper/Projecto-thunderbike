<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>proveedors</title>
    <link rel="icon" type="thundrbike/png" href="img/thunderbike.png">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 50px 0 0 0; /* 50px de padding arriba, 0 en los otros lados */
            background-image: url('https://wallpaperaccess.com/full/5651708.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }




        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20 px;
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


        #proveedorForm input {
            width: calc(100% - 22px); /* Se resta el ancho del padding */
            padding: 10px;
            margin-top: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }


        #proveedorForm button {
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


        #proveedorForm button:hover {
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
        <h1>Listado de proveedores</h1>
        <div class="button-container">
            <button class="button" onclick="showAddForm()">Agregar proveedor</button>
        </div>
        <table id="proveedores">
            <!-- Cabecera de la tabla -->
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Acciones</th> <!-- Nueva columna para botones de editar y borrar -->
            </tr>
            <!-- Datos de los proveedores -->
            <?php
            include "controladores/conexion.php";
            ?>
        </table>
       
        <div id="formContainer">
            <h2 id="formTitle">Agregar proveedor</h2>
            <form id="proveedorForm" method="post">
                <input type="hidden" id="proveedorId" name="proveedorId">
                <input type="text" id="proveedorName" name="proveedorName" placeholder="Nombre" required>
                <input type="text" id="proveedorAddress" name="proveedorAddress" placeholder="Dirección" required>
                <input type="text" id="proveedorPhone" name="proveedorPhone" placeholder="Teléfono" required>
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
            document.getElementById('formTitle').innerText = 'Agregar proveedor';
            document.getElementById('proveedorForm').reset();
            document.getElementById('formContainer').style.display = 'block';
        }


        function showEditForm(proveedor_Id, name, address, phone) {
            document.getElementById('formTitle').innerText = 'Editar proveedor';
            document.getElementById('proveedorForm').reset();
            document.getElementById('proveedorId').value = proveedor_Id;
            document.getElementById('proveedorName').value = name;
            document.getElementById('proveedorAddress').value = address;
            document.getElementById('proveedorPhone').value = phone;
            document.getElementById('formContainer').style.display = 'block';
        }


        function cancelForm() {
            document.getElementById('formContainer').style.display = 'none';
        }


        function deleteproveedor(proveedor_Id) {
            if (confirm("¿Estás seguro de que deseas eliminar este proveedor?")) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                    }
                };
                xhttp.open("POST", "controladores/save_proveedor.php", true);
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhttp.send("action=delete&proveedorId=" + proveedor_Id);
            }
        }


        function submitForm() {
            var proveedor_Id = document.getElementById('proveedorId').value;
            var name = document.getElementById('proveedorName').value;
            var address = document.getElementById('proveedorAddress').value;
            var phone = document.getElementById('proveedorPhone').value;
            var action = proveedor_Id ? 'edit' : 'add';


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
            xhttp.open("POST", "controladores/save_proveedor.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("action=" + action + "&proveedorId=" + proveedor_Id + "&proveedorName=" + encodeURIComponent(name) + "&proveedorAddress=" + encodeURIComponent(address) + "&proveedorPhone=" + encodeURIComponent(phone));


            return false;
        }


        function goToHome() {
            window.location.href = "index.php";
        }
    </script>
   
</body>
</html>
