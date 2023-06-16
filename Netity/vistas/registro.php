<?php
include "../includes/db_connect.php";

// Variables para almacenar los valores ingresados en el formulario
$nombreUsuario = '';
$email = '';
$phone = '';
$nombre = '';
$apellido_1 = '';
$apellido_2 = '';

if (isset($_POST['register'])) {
    // Obtener los valores del formulario
    $nombreUsuario = trim($_POST['username']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $nombre = trim($_POST['nombre']);
    $apellido_1 = trim($_POST['primerApellido']);
    $apellido_2 = trim($_POST['segundoApellido']);
    $password = trim($_POST['password']);


    // Verificar la disponibilidad del nombre de usuario
    $consultaUsuario = "SELECT Nombre_Usuario FROM usuario WHERE Nombre_Usuario = '$nombreUsuario'";
    $resultadoUsuario = mysqli_query($conn, $consultaUsuario);

    // Verificar la disponibilidad del correo electrónico
    $consultaEmail = "SELECT Email FROM usuario WHERE Email = '$email'";
    $resultadoEmail = mysqli_query($conn, $consultaEmail);

    // Verificar la disponibilidad del número de teléfono
    $consultaTelefono = "SELECT Telefono FROM usuario WHERE Telefono = '$phone'";
    $resultadoTelefono = mysqli_query($conn, $consultaTelefono);

    if (mysqli_num_rows($resultadoUsuario) > 0) {
        // El nombre de usuario ya está registrado
        $error_messageUsuario = "Nombre de usuario repetido";
    } elseif (mysqli_num_rows($resultadoEmail) > 0) {
        // El correo electrónico ya está registrado
        $error_messageEmail = "Este email ya está registrado";
    } elseif (mysqli_num_rows($resultadoTelefono) > 0) {
        // El número de teléfono ya está registrado
        $error_messageTelefono = "Este telefono ya está registrado";
    } else {
        // Insertar el usuario en la base de datos
        $consulta = "INSERT INTO usuario (Nombre_Usuario, Nombre, Apellido_1, Apellido_2, Contraseña, Email, Telefono, Premium) VALUES ('$nombreUsuario', '$nombre', '$apellido_1', '$apellido_2', MD5('$password'), '$email', '$phone', 'N' )";
        $resultado = mysqli_query($conn, $consulta);

        if ($resultado) {
            header("Location: inicio_sesion.php");
        } else {
            echo "<h3 class='bad'>¡Ups, ha ocurrido un error al registrar el usuario!</h3>";
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <link rel="icon" href="../imagenes/LOGO1.png">
    <title>Netity_Registro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/scroll.css">


</head>

<body>
    <nav class="navbar">
        <div class="logo-container">
            <div class="logo-container">
                <a href="../index.html"><img src="../imagenes/LOGO.png" alt="Logo"></a>
            </div>
        </div>
    </nav>


    <div class="container">
        <div class="image-container">
            <img src="../imagenes/fotoLogin.png" alt="Logo" width="100">
        </div>
        <div class="form-wrapper">
            <div class="form-container">
                <h3 class="text-center mb-3">Regístrate</h3>
                <form id="singUp" action="" method="post">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Ingresa tu nombre de usuario" value="<?php echo $nombreUsuario; ?>">
                                <?php if (isset($error_messageUsuario)) : ?>
                                    <p class="validation-error"><?php echo $error_messageUsuario; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingresa tu nombre" value="<?php echo $nombre; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="primerApellido" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" id="primerApellido" name="primerApellido" placeholder="Ingresa tu primer apellido" value="<?php echo $apellido_1; ?>">
                            </div>
                            <div class="mb-3">
                                <label for="segundoApellido" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" id="segundoApellido" name="segundoApellido" placeholder="Ingresa tu segundo apellido" value="<?php echo $apellido_2; ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Ingresa tu email" name="email" value="<?php echo $email; ?>">
                                <?php if (isset($error_messageEmail)) : ?>
                                    <p class="validation-error"><?php echo $error_messageEmail; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="phone" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="phone" placeholder="Ingresa tu número de teléfono" name="phone" value="<?php echo $phone; ?>">
                                <?php if (isset($error_messageTelefono)) : ?>
                                    <p class="validation-error"><?php echo $error_messageTelefono; ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" placeholder="Ingresa tu contraseña" name="password">
                                    <button class="btn btn-outline-secondary eye-button" type="button" id="showPassword">
                                        <i class="bi bi-eye eye-icon"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="confirmPassword" class="form-label">Repite la contraseña</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Repite tu contraseña">
                                    <button class="btn btn-outline-secondary eye-button" type="button" id="showConfirmPassword">
                                        <i class="bi bi-eye eye-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary" name="register">Registrarse</button>
                    </div>
                    <div class="mb-3">
                        <div class="link-wrapper">
                            ¿Ya estás registrado? Pulsa <a href="inicio_sesion.php">aquí</a>.
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="logo-container2">
            <img src="../imagenes/fotoPiePagina.png" alt="Imagen de fondo">
        </div>
    </div>

    <script src="../js/registro.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/registro.css">

</body>

</html>