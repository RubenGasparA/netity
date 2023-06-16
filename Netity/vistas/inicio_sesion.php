<?php
session_start(); // Inicia la sesión

include "../includes/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtén los datos enviados desde el formulario de inicio de sesión
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Consulta SQL para verificar las credenciales del usuario
    $md5pass = md5($password);
    $sql = "SELECT * FROM usuario WHERE Nombre_Usuario = '$username' AND Contraseña = '$md5pass'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // El usuario y la contraseña son válidos
        $_SESSION["username"] = $username;
        header("Location: home.php");
        exit();
    } else {
        // El usuario y/o la contraseña son incorrectos
        $error_message = "Usuario y/o contraseña incorrectos";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netity_Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/inicio_sesion.css">
    <link rel="icon" href="../imagenes/LOGO1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/scroll.css">

</head>

<body>
    <nav class="navbar">
        <div class="logo-container">
            <div class="logo-container">
                <a href="../index.html"><img src="../imagenes/LOGO.png" alt="Logo">
                </a>
            </div>
        </div>
    </nav>


    <div class="container">

        <div class="image-container">
            <img src="../imagenes/fotoLogin.png" alt="Logo" width="100">
        </div>

        <div class="form-wrapper">
            <div class="form-container">

                <h3 class="text-center mb-3">Iniciar sesión</h3>
                <form id="loginForm" action="" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Usuario</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Ingresa tu nombre de usuario">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" name="password">
                            <button class="btn btn-outline-secondary eye-button" type="button" id="showPassword">
                                <i class="bi bi-eye eye-icon"></i>
                            </button>
                        </div>
                        <?php if (isset($error_message)) : ?>
                            <p class="validation-error"><?php echo $error_message; ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <div class="link-wrapper">
                            ¿No estás registrado? Pulsa <a href="registro.php">aquí</a>.
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="inicioSesion">Iniciar sesión</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="logo-container2">
            <img src="../imagenes/fotoPiePagina.png" alt="Imagen de fondo">
        </div>
    </div>



    <script src="../js/inicio_sesion.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>