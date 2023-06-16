<?php
include '../includes/funciones.php';

// Verificar si el nombre de usuario está almacenado en la sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: inicio_sesion.php");
}

$premium = obtenerPremium();


?>

<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>

    <meta charset="utf-8">
    <link rel="icon" href="../imagenes/LOGO1.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.111.3">
    <title>Netity_Home</title>
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/home.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/scroll.css">

</head>

<body>

    <!-- barra de navegación -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary sidebar" style="width: 280px;">
        <a href="" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <img src="../imagenes/LOGO1.png" style="width: 50px;" alt="">
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="home.php" class="nav-link link-body-emphasis" aria-current="page">
                    <i class="bi bi-house" width="16" height="16">
                        <use xlink:href="#home" />
                    </i>
                    Home
                </a>
            </li>
            <li>
                <a href="verDispositivos.php" class="nav-link link-body-emphasis">
                    <i class="bi bi-diagram-3" width="16" height="16">
                        <use xlink:href="#speedometer2" />
                    </i>
                    Tus Dispositivos
                </a>
            </li>
            <li>
                <a href="test/speedtest/public/index.html" class="nav-link link-body-emphasis">
                    <i class="bi bi-speedometer2" width="16" height="16">
                        <use xlink:href="#grid" />
                    </i>
                    Test De Velocidad
                </a>
            </li>
            <li>
                <a href="soporte.php" class="nav-link link-body-emphasis">
                    <i class="bi bi-headset" width="16" height="16">
                        <use xlink:href="#people-circle" />
                    </i>
                    Soporte
                </a>
            </li>
        </ul>
        <hr>
        <div class="dropdown d-flex align-items-center">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../imagenes/descarga.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?php echo $username ?></strong>
            </a>
            <?php if ($premium === 'S') { ?>
                <img style="width: 10%; margin-left: 10px;" src="../imagenes/estrellaPremium.png" alt="premium">
            <?php } else { ?>
            <?php } ?>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" style="color: #3d9cd5 !important;" href="#">Ajustes</a></li>
                <li><a class="dropdown-item" style="color: #3d9cd5 !important;" href="perfil.php">Mi Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" style="color: #3d9cd5 !important;" href="../includes/logout.php">Desconectarse</a></li>
            </ul>
        </div>

    </div>


    <main class="content" id="main">

        <button class="bi bi-list toggle-sidebar-btn" style="margin-left: 97.5%; margin-bottom: 9.5%;"></button>


        <div class="row mb-3">
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative divArriba">
                    <div class="col p-4 d-flex flex-column position-static">

                        <h2 class='titulo'>TEST DE VELOCIDAD</h2>
                        <h2 class='descripcion'>X dispositivos en línea</h2>

                        <a href="test/speedtest/public/index.php">
                            <button class='botonAzulArriba'>TEST DE VELOCIDAD</button>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative divArriba">
                    <div class="col p-4 d-flex flex-column position-static">
                        <h2 class='titulo'>DISPOSITIVOS CONECTADOS</h2>
                        <h2 class='descripcion'>X dispositivos conectados</h2>
                        <a href="verDispositivos.php">
                            <button class='botonAzulArriba'>VER DISPOSITIVOS</button>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">

                    </div>
                </div>
            </div>
        </div>

        <div class="p-4 p-md-5 mb-4 rounded divAbajo">
            <div class="col-md-12 px-0">
                <h2 class='titulo'>VULNERABILIDADES ENCONTRADAS</h2>
                <h2 class='descripcion'>Protégete de cualquier fallo gracias a nuestro servicio premium</h2>
                <?php if ($premium === 'S') { ?>
                    <a href="../templates/indexV.php">
                        <button class='botonAzulAbajo'>VER VULNERABILIDADES</button>
                    </a>
                <?php } else { ?>
                    <a href="compra.php">
                        <button class='botonAzulAbajo'>OBTÉN PREMIUM</button>
                    </a>
                <?php } ?>
            </div>
        </div>
    </main>






    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="Home.js"></script>
    <script src="../js/perfil_assets.js"></script>

</body>

</html>