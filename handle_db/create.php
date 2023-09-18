<?php
// Requiere el archivo de configuración y conexión a la base de datos
require_once($_SERVER["DOCUMENT_ROOT"] . "/config/database.php");

// Función para verificar si el correo ya existe
function correoExiste($mysqli, $correo) {
    $consulta = $mysqli->prepare("SELECT email FROM `usuarios` WHERE email = ?");
    $consulta->bind_param("s", $correo);
    $consulta->execute();
    $consulta->store_result();
    return $consulta->num_rows > 0;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $correo = $_POST["correo"];
    $contrasena = $_POST["contrasena"];

    if (correoExiste($mysqli, $correo)) {
        echo "La cuenta ya existe. Por favor, utiliza otro correo.";
    } else {
        // Hash de la contraseña
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $insertar = $mysqli->prepare("INSERT INTO usuarios(email, password) VALUES (?, ?)");
        $insertar->bind_param("ss", $correo, $hash);

        if ($insertar->execute()) {
            session_start();
            // Almacenar información del usuario en variables de sesión
            $_SESSION['email'] = $correo;
            $_SESSION['id'] = $mysqli->insert_id; // Obtener el ID del usuario recién insertado
            $_SESSION['phone'] = '';
            $_SESSION['bio'] = '';
            $_SESSION['name'] = '';

            // Redirigir al usuario
            header("Location: /portafolio.php");
            exit();
        } else {
            echo "Error al registrar un usuario.";
        }

        $insertar->close();
    }
}

$mysqli->close();
?>













