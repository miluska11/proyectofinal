<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

require_once "./config/database.php";

$id = $_SESSION['id'];

// Cambia esta línea para usar una consulta preparada
$stmt = $mysqli->prepare("SELECT photo FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($dataImg);
$stmt->fetch();
$stmt->close();

// Convierte los datos binarios en una URL de datos
$imageData = base64_encode($dataImg);
$imageMimeType = "image/jpeg";  // Cambia esto según el tipo de imagen que almacenas

// Genera la URL de datos
$imageSrc = "data:" . $imageMimeType . ";base64," . $imageData;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css/portafolio.css">
    <link href="/dist/output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <nav>
        <ul class="nav flex items-center space-x-48">
            <li class="mt-4">
                <img class="w-40 h-6 ml-20" src="/img/dev.jpg" alt="">
            </li>
        </ul>
        <li id="close">
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

            <nav id="navigation" class="hidden">
                <hr class="w-40 bg-gray-300">
                <div class="options-li flex flex-col items-end absolute top-16 right-20">
                    <div class="bg-white p-4 rounded border border-gray-300 shadow-md w-40 h-auto mb-4">
                        <div class="flex items-center mb-2">
                            <img class="person w-8 h-8 rounded-full mr-2" src="/img/usuario.png" alt="Imagen de perfil">
                            <a href="/portafolio.php" class="text-gray-600 font-semibold text-sm">My Profile</a>
                        </div>
                        <div class="flex items-center mb-2">
                            <img class="grupo w-8 h-8 rounded-full mr-2" src="/img/grupo.png" alt="Icono de grupo">
                            Group chat
                        </div>
                        <form action="/config/direccionar.php">
                            <div class="mt-4">
                                <button class="boton-close flex items-center text-red-500 text-sm">
                                    <img class="cerrar w-4 h-4 mr-2" src="/img/cerrar-sesion.png" alt="Icono de cierre">
                                    Logout
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </nav>
        </li>
    </nav>

    <div class="flex justify-center items-center flex-col">
        <div class="texto">
            <p class="text-black text-3xl font-normal leading-normal tracking-tighter">Personal Info</p>
            <p class="text-black text-base font-light leading-normal tracking-tight mb-8">Basic info, like your name and photo</p>
        </div>

        <div class="container-user-info w-[845.911px] border border-gray-300 rounded-lg p-5">
            <div class="profile-edit flex flex-col md:flex-row items-center mb-5">
                <div class="container-profile w-700.384 mb-3 md:mb-0">
                    <p class="text-gray-700 font-semibold text-sm">Profile</p>
                    <p class="text-gray-400 text-sm">Some info may be visible to other people</p>
                </div>
                <div class="contenedor-edit mt-3 md:mt-0 ml-0 md:ml-3">
                    <a href="/portafolio_edit.php">
                        <button class="edit-info text-gray-700 font-semibold text-sm px-4 py-1 rounded border border-gray-300">Edit</button>
                    </a>
                </div>
            </div>

            <div class="con-photo w-900">
        <div class="text-gray-400 font-medium text-sm">PHOTO</div>
        <div class="imagen-container">
            <img src="<?php echo $imageSrc; ?>" alt="Imagen de perfil">
        </div>
    </div>

            <div class="name border border-gray-300 rounded-lg p-5 mb-5">
                <div class="con-name text-gray-400 ">
                    <p>NAME</p>
                    <p><?php echo $_SESSION['name']; ?></p>
                </div>
            </div>

            <div class="bio border border-gray-300 rounded-lg p-5 mb-5">
                <div class="con-bio text-gray-400 ">
                    <p>BIO</p>
                    <p><?php echo $_SESSION['bio']; ?></p>
                </div>
            </div>

            <div class="phone border border-gray-300 rounded-lg p-5 mb-5">
                <div class="con-phone text-gray-400 ">
                    <p>PHONE</p>
                    <p><?php echo $_SESSION['phone']; ?></p>
                </div>
            </div>

            <div class="mail border border-gray-300 rounded-lg p-5 mb-5">
                <div class="con-mail text-gray-400 ">
                    <p>EMAIL</p>
                    <p><?php echo $_SESSION['email']; ?></p>
                </div>
            </div>

            <div class="password border border-gray-300 rounded-lg p-5">
                <div class="con-pasword text-gray-400 ">
                    <p>PASSWORD</p>
                    <p class="text-center">***********************</p>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/nav.js"></script>
</body>

</html>