

<?php
session_start();// Iniciar la sesión para verificar si el usuario está autenticado
if (!isset($_SESSION['email'])) {// Verificar si el usuario no ha iniciado sesión
header('Location: index.php');// Redirigir al usuario a la página de inicio de sesión si no está autenticado
    exit(); 
}
require_once "./config/database.php";// conexión a la base de datos
$id = $_SESSION['id'];// Obtener el ID de usuario de la sesión actual
// Consultar la base de datos para obtener la imagen de perfil del usuario
$stmt = $mysqli->query("SELECT id, photo FROM usuarios WHERE id = '$id';");
while ($row = $stmt->fetch_assoc()) {// Convertir la imagen binaria en formato base64
$dataImg = base64_encode($row["photo"]);// $dataImg ahora contiene la imagen de perfil codificada en base64

}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css/portafolio_edit.css">
    <link href="/dist/output.css" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>

   
</head>

<body>
    <!-- Barra de navegación -->
    <ul class="nav flex items-center space-x-48">
        <li class="mt-4">
            <img class="w-40 h-6 ml-20" src="/img/dev.jpg" alt="">
        </li>
    </ul>

    <div class="flex justify-center items-center flex-col">
        <!-- Encabezado con botón "Back" -->
        <div class="back-container flex items-center justify-start w-650px pb-20 mt-15 ">
            <img src="/img/angle-left.png" alt="Back" class="w-4 h-4 " />
            <a href="/portafolio.php" class="text-blue-500">Back</a>
        </div>

        <!-- Imagen de perfil y botón -->
        <div class="fixed top-0 right-0">
    <div class="flex items-center justify-end">
        <div class="imagen-container-nav mr-5">
            <img class="foto w-8 h-8 mt-5" src="/img/pikachu_artwork.0.jpg" alt="">
        </div>
        <p class="text-sm text-gray-600 mt-4">Xanthe Neal</p>
        
        <button id="flecha">
            <img class="boton w-4 h-4 mr-20 ml-2 mt-2" src="/img/download.png" alt="Descripción de la imagen">
        </button>
    </div>
</div>


        <!-- Navegación de usuario -->
        <nav class="options">
            <hr class="w-40 bg-gray-300">
            <div class="options-li flex flex-col items-end absolute top-16 right-20"> <!-- Ajusta el valor de top aquí -->
                <div class="bg-white p-4 rounded border border-gray-300 shadow-md w-40 h-auto mb-4">
                    <div class="flex items-center mb-2">
                        <img class="person w-8 h-8 rounded-full mr-2" src="/img/usuario.png" alt="Imagen de perfil">
                        <a href="/portafolio.php" class="text-gray-600 font-semibold text-sm">My Profile</a>
                    </div>

                    <div class="flex items-center mb-2">
                        <img class="grupo w-8 h-8 rounded-full mr-2" src="/img/grupo.png" alt="Icono de grupo">
                        Group chat
                    </div>
                    <div class="mt-4">
                        <button class="boton-close flex items-center text-red-500 text-sm">
                            <img class="cerrar w-4 h-4 mr-2" src="/img/cerrar-sesion.png" alt="Icono de cierre">
                            Logout
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Formulario de edición de usuario -->
        <div class="user-edit-info">
            <div class="container-user">
                <div class="container-change-info">
                    <p class="font-semibold text-lg">Change Info</p>
                    <p>Changes will be reflected to every service</p>
                </div>
                
                  <form action="/handle_db/foto.php" enctype="multipart/form-data" class="form-edit" method="post">
                  <div class="flex items-center gap-2">
                        <label class="relative cursor-pointer" > 
                              <img src="/img/zImage6.jpg" alt="Upload" class="w-12 h-12 mt-8 ml-2" />
                     <input type="file" name="imagen" class="sr-only" /></label>
              
                <p class="text-gray-600 ml-2 mt-8">CHANGE PHOTO</p>
                    </div>
                    <div class="name pt-4 flex flex-col">Name
                        <input type="text" class="nombre rounded-lg border border-gray-300 h-16 px-4"
                            placeholder="Enter your name..." name="name"value="<?php echo $_SESSION['name'] ?>">
                    </div>
                    <div class="bio pt-4 flex flex-col">Bio
                        <input type="text" class="bio-input rounded-lg border border-gray-300 h-16 px-4"
                            placeholder="Enter Your Bio" name="bio" value="<?php echo $_SESSION['bio'] ?>">
                    </div>
                    <div class="phone pt-4 flex flex-col">Phone
                        <input type="text" class="phone-input rounded-lg border border-gray-300 h-16 px-4"
                            placeholder="Enter your phone" name="phone"  value="<?php echo $_SESSION['phone'] ?>">
                    </div>
                    <div class="email pt-4 flex flex-col">Email
                        <input type="email" class="email-input rounded-lg border border-gray-300 h-16 px-4"
                            placeholder="Enter your email" name="email" value="<?php echo $_SESSION['email'] ?>">
                    </div>
                    <div class="password pt-4 flex flex-col">Password
                        <input type="password" class="password-input rounded-lg border border-gray-300 h-16 px-4"
                            placeholder="Enter Your Password" name="password">
                    </div>
                    <div class="containerboton pt-4">
                    <button type="submit" class="botton-save text-white text-base font-medium rounded-lg bg-blue-500 w-20 h-8">Save</button>
                      </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="/js/nav.js"></script>
</html>
