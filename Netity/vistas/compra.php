<?php
session_start(); // Asegúrate de incluir session_start() al comienzo del archivo

// Verificar si el nombre de usuario está almacenado en la sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: ../index.html");
}



if (isset($_POST['premium'])) {
    $username = $_SESSION['username'];
    $consulta = "UPDATE usuario SET Premium = 'S' WHERE Nombre_Usuario = '$username'";


    $resultado = mysqli_query($conn, $consulta);
    if ($resultado) {
        header("Location: home.php");
    } else {
?>
        <h3 class="bad">¡Ups ha ocurrido un error!</h3>
<?php
    }
}

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
    <title>Netity_Compra</title>
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/compra.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/scroll.css">

</head>

<body>

    <!-- barra de navegación -->
    <div class="d-flex flex-column flex-shrink-0 p-3 bg-body-tertiary sidebar" style="width: 280px;">
        <a href="home.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
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
        <div class="dropdown">
            <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="../imagenes/descarga.png" alt="" width="32" height="32" class="rounded-circle me-2">
                <strong><?php echo $username ?></strong>
            </a>
            <ul class="dropdown-menu text-small shadow">
                <li><a class="dropdown-item" style="color: #3d9cd5 !important;" href="#">Ajustes</a></li>
                <li><a class="dropdown-item" style="color: #3d9cd5 !important;" href="perfil.php">Mi
                        Perfil</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" style="color: #3d9cd5 !important;" href="../includes/logout.php">Desconectarse</a></li>
            </ul>
        </div>
    </div>


    <div class="content" id="main" style="display: flex;">
        <div class="container">
            <button class="bi bi-list toggle-sidebar-btn" style="margin-left: 97.5%; margin-bottom: 7.5%"></button>

            <div class="row  row-cols-1 row-cols-xl-3 row-cols-lg-1 row-cols-md-1 row-cols-sm-1 mb-3 text-center">
                <!-- "row-cols-1" cantidad de columnas que se ponen cuando se hace pequeña la pantalla  -->

                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">1 MES</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">8.99€<small class="text-body-secondary fw-light">/mes</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <br>
                                <li>107.88€</li>
                                <li>en un año</li>
                                <br>
                                <br>
                            </ul>
                            <a href="pasarela.php"><button type="button" name="premium" class="w-100 btn btn-lg btn-primary">COMPRAR</button></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm border-primary">
                        <div class="card-header py-3 text-bg-primary border-primary">
                            <h4 class="my-0 fw-normal">1 AÑO</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">6.29€<small class="text-body-secondary fw-light">/mes</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <br>
                                <li>75.48€</li>
                                <li>en un año</li>
                                <br>
                                <li>!Te ahorras un 30%¡</li>
                            </ul>
                            <a href="pasarela.php"> <button type="button" name="premium" class="w-100 btn btn-lg btn-primary">COMPRAR</button></a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card mb-4 rounded-3 shadow-sm">
                        <div class="card-header py-3">
                            <h4 class="my-0 fw-normal">1 SEMESTRE</h4>
                        </div>
                        <div class="card-body">
                            <h1 class="card-title pricing-card-title">6.74€<small class="text-body-secondary fw-light">/mes</small></h1>
                            <ul class="list-unstyled mt-3 mb-4">
                                <br>
                                <li>40.45</li>
                                <li>en un semestre</li>
                                <br>
                                <li>!Te ahorras un 25%¡</li>
                            </ul>
                            <a href="pasarela.php"><button type="button" name="premium" class="w-100 btn btn-lg btn-primary">COMPRAR</button></a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="p-4 p-md-5 mb-4 rounded divAbajo">
                <div class="col-md-12 px-0 ">
                    <h2>Período de prueba</h2>
                    <ul class="list-unstyled ">
                        <li>- La prueba comienza después de seleccionar un plan, lo que otorga acceso a todas las
                            funcionalidades de Netity Premium en cada plataforma en la que inicie sesión.</li>
                        <li>- No se contabiliza ninguna facturación durante el período de prueba</li>
                        <li>- La primera factura ocurrirá al final de período de prueba</li>
                    </ul>
                </div>
            </div>
            <div class="p-4 p-md-5 mb-4 rounded divAbajo">
                <div class="col-md-12 px-0">
                    <h2>La suscripción se renueva automáticamente</h2>
                    <ul class="list-unstyled ">
                        <li>- El pago se cargará a tu cuenta bancaria tras la confirmación de la compra.</li>
                        <li>- Se te cobrará por otro período a menos que canceles al menos 24 horas antes de que se
                            renueve la suscripción</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    
    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/perfil_assets.js"></script>
</body>

</html>