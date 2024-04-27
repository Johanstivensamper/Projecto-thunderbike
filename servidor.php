<?php
session_start();

// inicializar variables
$username = "";
$email    = "";
$errors = array(); 

// coneccion a la base de datos
$db = mysqli_connect('localhost', 'root', '', 'thunderbike');

// REGISTRAR USUARIO
if (isset($_POST['reg_user'])) {
  // recibir todos los valores de entrada del formulario
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $role = mysqli_real_escape_string($db, $_POST['role']); // Obtener el rol del formulario

  // validación del formulario: asegúrese de que el formulario esté correctamente completado...
  // agregando (array_push()) el error correspondiente a la matriz $errors
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
    array_push($errors, "The two passwords do not match");
  }

  // primero verifique la base de datos para asegurarse si
  // un usuario no existe ya con el mismo nombre de usuario y/o correo electrónico
  $user_check_query = "SELECT * FROM usuarios WHERE nombre='$username' OR correo='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // Si el usuario existe
    if ($user['nombre'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['correo'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finalmente, registre al usuario si no hay errores en el formulario.
  if (count($errors) == 0) {
    $password = md5($password_1);//cifrar la contraseña antes de guardarla en la base de datos

    $query = "INSERT INTO usuarios (nombre, correo, clave, rol) 
          VALUES('$username', '$email', '$password', '$role')"; // Insertar el rol también
    mysqli_query($db, $query);
    $_SESSION['username'] = $username;
    $_SESSION['success'] = "You are now logged in";
    header('location: index.php');
  }
}
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Nombre de Usuario requerido");
    }
    if (empty($password)) {
        array_push($errors, "Contraseña es requerida");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM usuarios WHERE nombre='$username' AND clave='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "Ahora está conectado";
          // Obtener el rol del usuario y guardarlo en la sesión
          $user = mysqli_fetch_assoc($results);
          $_SESSION['role'] = $user['rol'];
          header('location: index.php');
        }else {
            array_push($errors, "Combinación incorrecta de nombre de usuario/contraseña");
        }
    }
}
?>

