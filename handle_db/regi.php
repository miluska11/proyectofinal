<?php 
session_start();

// Datos de conexión a la base de datos
$host = "localhost";
$username = "root";
$password = "";
$database = "login_db";

try {
    // Crear una nueva conexión a la base de datos
    $mysqli = new mysqli($host, $username, $password, $database);

    // Verificar si la conexión se estableció correctamente
    if ($mysqli->connect_error) {
        die("Error de conexión a la base de datos: " . $mysqli->connect_error);
    }

    // Recuperar los datos del formulario de inicio de sesión
    $correo = $_POST["correo"];
    $password = $_POST["contrasena"];

    // Utilizar una consulta preparada para evitar SQL injection
    $consulta = $mysqli->prepare("SELECT id, email, password, phone, biografia, name FROM `usuarios` WHERE email = ?");
    $consulta->bind_param("s", $correo);
    $consulta->execute();
    $resultado = $consulta->get_result()->fetch_assoc();

    // Verificar si se encontró un usuario con ese correo
    if ($resultado && password_verify($password, $resultado['password'])) {
        // Las credenciales son correctas, iniciar sesión
        $_SESSION['id'] = $resultado['id'];
        $_SESSION['email'] = $resultado['email'];
        $_SESSION['phone'] = $resultado['phone'];
        $_SESSION['bio'] = $resultado['biografia'];
        $_SESSION['name'] = $resultado['name'];
        header("Location: ../portafolio.php");
        exit();
    } else {
        // Credenciales incorrectas, mostrar mensaje de error
        echo "Correo o contraseña incorrectos";
    }
    
    // Cerrar la conexión a la base de datos
    $mysqli->close();
} catch(mysqli_sql_exception $e) {
    // Capturar cualquier excepción de MySQL
    echo "Error: " . $e->getMessage();
}
?>





























