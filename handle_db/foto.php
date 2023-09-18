<?php
session_start();

require_once "../config/database.php";

$id = $_SESSION['id'];

// Verificar si se ha cargado una nueva imagen de perfil
if (isset($_FILES["imagen"]) && !empty($_FILES["imagen"]["tmp_name"])) {
    // Obtener datos de la imagen cargada
    $imagenTmpName = $_FILES["imagen"]["tmp_name"];

    // Verificar si no hay errores en la carga de archivos
    if ($_FILES["imagen"]["error"] === UPLOAD_ERR_OK) {
        // Leer y codificar la imagen en base64
        $dataImg = base64_encode(file_get_contents($imagenTmpName));

        // Guardar la imagen codificada en la sesión (opcional)
        $_SESSION['photo'] = $dataImg;
            // Procesar la imagen y almacenarla en la base de datos
            $dataImg = addslashes(file_get_contents($_FILES["imagen"]["tmp_name"]));
            $updateQuery = "UPDATE `usuarios` SET `photo` = ? WHERE `usuarios`.`id` = ?";
            $updateStmt = $mysqli->prepare($updateQuery);
            $updateStmt->bind_param("si", $dataImg, $id);

            if ($updateStmt->execute()) {
                // Éxito al actualizar la imagen
                $_SESSION['photo'] = base64_encode($dataImg);
                header("Location: /portafolio.php");
                exit();
            } else {
                echo "Error al actualizar la imagen en la base de datos.";    
            }

            $updateStmt->close();
        } else {
            echo "Tipo de archivo no permitido. Solo se permiten imágenes JPEG.";
        }
    } else {
        echo "Error al cargar la imagen. Código de error: " . $_FILES["imagen"]["error"];
    }


// Verificar si alguno de los campos de perfil no está vacío
if (!empty($_POST["name"])) {
    $name = $_POST["name"];
    $_SESSION['name'] = $name;
}
if (!empty($_POST["bio"])) {
    $bio = $_POST["bio"];
    $_SESSION['bio'] = $bio;
}
if (!empty($_POST["phone"])) {
    $phone = $_POST["phone"];
    $_SESSION['phone'] = $phone;
}
if (!empty($_POST["password"])) {
    $password = $_POST["password"];
    $contrahash = password_hash($password, PASSWORD_DEFAULT);
    $_SESSION['password'] = $contrahash;
}

// Construir la consulta SQL para actualizar los campos
$query = "UPDATE `usuarios` SET ";
if (isset($name)) {
    $query .= "`name` = '$name', ";
}
if (isset($bio)) {
    $query .= "`biografia` = '$bio', ";
}
if (isset($phone)) {
    $query .= "`phone` = '$phone', ";
}
if (isset($password)) {
    $query .= "`password` = '$contrahash', ";
}

$query = rtrim($query, ", ");
$query .= " WHERE `usuarios`.`id` = $id;";

// Ejecutar la consulta SQL
$mysqli->query($query);
header("Location: /portafolio.php");
exit();
?>

