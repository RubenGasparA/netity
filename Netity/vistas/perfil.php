<?php
include "../includes/funciones.php";
include "../includes/db_connect.php";

// Verificar si el nombre de usuario está almacenado en la sesión
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  header("Location: ../index.html");
}

$idUsuario = obtenerID();
$email = obtenerCorreoElectronicoUsuario();
$telefono = obtenerTelefono();
$nombre = obtenerNombre();
$apellido1 = obtenerApellido1();
$apellido2 = obtenerApellido2();
$imagen = obtenerImagen();
$premium = obtenerPremium();
$idUsuario = obtenerID();

$error_messageTelefono  = '';
$error_messageEmail = '';
$error_messageContraseña = '';








if (isset($_POST['update'])) {
  // Obtener nuevos datos enviados por el formulario
  $nuevoNombre = $_POST['fullName'];
  $nuevoApellido1 = $_POST['company'];
  $nuevoApellido2 = $_POST['Job'];
  $nuevoTelefono = $_POST['phone'];

  // Verificar si el número de teléfono ya está registrado para otro usuario
  $consultaTelefono = "SELECT Telefono FROM usuario WHERE Telefono = '$nuevoTelefono' AND Id_Usuario != '$idUsuario'";
  $resultadoTelefono = mysqli_query($conn, $consultaTelefono);

  if (mysqli_num_rows($resultadoTelefono) > 0) {
    // El número de teléfono ya está registrado para otro usuario
    $error_messageTelefono = "Este teléfono ya está registrado para otro usuario.";
  } else {
    // Insertar el usuario en la base de datos
    $sql = "UPDATE usuario SET Nombre = '$nuevoNombre', Apellido_1 = '$nuevoApellido1', Apellido_2 = '$nuevoApellido2', Telefono = '$nuevoTelefono' WHERE Id_Usuario = '$idUsuario'";
    $resultado = mysqli_query($conn, $sql);

    if ($resultado) {
      // La información se ha actualizado correctamente
      $nombre = $nuevoNombre;
      $apellido1 = $nuevoApellido1;
      $apellido2 = $nuevoApellido2;
      $telefono = $nuevoTelefono;
    } else {
      // Ha ocurrido un error al actualizar la información
      echo "Ha ocurrido un error al actualizar la información.";
    }
  }
}


if (isset($_POST['change'])) {
  // Obtener nuevos datos enviados por el formulario
  $actualContraseña = $_POST['currentPassword'];
  $nuevaContraseña = $_POST['newpassword'];

  $md5pass = md5($password);
  $consultaContraseña = "SELECT Contraseña FROM usuario WHERE Id_Usuario = '$idUsuario'";
  $resultadoContraseña = mysqli_query($conn, $consultaContraseña);

  if (mysqli_num_rows($resultadoContraseña) == 1) {
    $row = mysqli_fetch_assoc($resultadoContraseña);
    $contrasena_almacenada = $row['Contraseña'];

    // Verificar si la contraseña actual coincide con la contraseña almacenada
    if ($contrasena_almacenada === md5($actualContraseña)) {
      // La contraseña actual es válida, insertar el usuario en la base de datos
      $sql = "UPDATE usuario SET Contraseña = md5('$nuevaContraseña') WHERE Id_Usuario = '$idUsuario'";
      $resultado = mysqli_query($conn, $sql);

      if ($resultado) {
        // La contraseña se ha cambiado correctamente
        $contraseña = $nuevaContraseña;
      } else {
        // Ha ocurrido un error al cambiar la contraseña
        echo "Ha ocurrido un error al cambiar la contraseña.";
      }
    } else {
      // La contraseña actual es incorrecta
      $error_messageContraseña = "La contraseña actual es incorrecta.";
    }
  }
}




if (isset($_POST['cancelPremium'])) {
  $username = $_SESSION['username'];
  $consulta = "UPDATE usuario SET Premium = 'N' WHERE Id_Usuario = '$idUsuario'";


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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Netity_Perfil</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <script>
    function validarFormulario() {
      var nuevaContrasena = document.getElementById("newPassword").value;
      var confirmarContrasena = document.getElementById("renewPassword").value;

      // Validar que la nueva contraseña y la confirmación coincidan
      if (nuevaContrasena !== confirmarContrasena) {
        alert("La nueva contraseña y la confirmación no coinciden.");
        return false; 
      }
      return true; 
    }
  </script>


  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="icon" href="../imagenes/LOGO1.png">
  <link href="../css/perfil.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/scroll.css">
  <link href="../assets/css/Perfil_assets.css" rel="stylesheet">
</head>

<body>
  <!-- barra de navegación -->
  <aside id="sidebar" class="sidebar">
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




  </aside>

  <main id="main" class="main">
    <i class="bi bi-list toggle-sidebar-btn" style="margin-left: 97.5%;"></i>

    <div class="pagetitle">
      <h1>Tú Perfil</h1>
    </div>

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="../imagenes/descarga.png" alt="Profile" class="rounded-circle">
              <h2><?php echo $nombre ?></h2>
            </div>
          </div>

          <div>

            <p class="validation-error">
              <?php echo $error_messageTelefono; ?>
              <?php echo $error_messageContraseña ?>
            </p>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Tus Datos</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar
                    contraseña</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-suscripcion">Suscripción</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">


                  <h5 class="card-title">Detalles del Perfil</h5>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label ">Nombre </div>
                    <div class="col-lg-9 col-md-8"><?php echo $nombre ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Apellidos</div>
                    <div class="col-lg-9 col-md-8"><?php echo $apellido1 . ', ' . $apellido2 ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Telefono</div>
                    <div class="col-lg-9 col-md-8"><?php echo $telefono ?></div>
                  </div>

                  <div class="row">
                    <div class="col-lg-3 col-md-4 label">Correo Electronico</div>
                    <div class="col-lg-9 col-md-8"><?php echo $email ?></div>


                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <form method="post">
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Imagen de Perfil</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?php echo $imagen ?>" alt="Profile">
                        <div class="pt-2">
                          <input type="file" class="btn btn-primary btn-sm" style="background-color: #2D9BF0;" name="upload">
                          <input class="btn btn-primary btn-sm" name="delete" style="background-color: #2D9BF0;" value="Cambiar">
                          <input class="btn btn-danger btn-sm" name="submit" value="Eliminar">
                        </div>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="fullName" value=<?php echo $nombre ?>>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">Primer Apellido</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="company" type="text" class="form-control" id="company" value=<?php echo $apellido1 ?>>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Segundo Apellido</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Job" type="text" class="form-control" id="Job" value=<?php echo $apellido2 ?>>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Telefono</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone" type="text" class="form-control" id="Phone" value=<?php echo $telefono ?>>
                        <p class="validation-error">
                        </p>
                      </div>
                    </div>

                    <div class="row mb-3" style="display: none;">
                      <label for="Id_Usuario" class="col-md-4 col-lg-3 col-form-label">ID</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Id_Usuario" type="Id_Usuario" class="form-control" id="Id_Usuario" value=<?php echo $idUsuario ?>>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="update" style="background-color: #2D9BF0;">Guardar Cambios</button>
                    </div>
                  </form>
                </div>



                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <form method="post" id="changePassword">
                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual</label>
                      <div class="col-md-8 col-lg-9 input-group">
                        <input name="currentPassword" type="password" class="form-control" id="currentPassword" required>
                        <button class="btn btn-outline-secondary eye-button" type="button" id="showCurrentPassword">
                          <i class="bi bi-eye eye-icon"></i>
                        </button>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva Contraseña</label>
                      <div class=" col-md-8 col-lg-9 input-group">
                        <input name="newpassword" type="password" class="form-control" id="newPassword" required>
                        <button class="btn btn-outline-secondary eye-button" type="button" id="showNewPassword">
                          <i class="bi bi-eye eye-icon"></i>
                        </button>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Repita Nueva Contraseña</label>
                      <div class="col-md-8 col-lg-9 input-group">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword" required>
                        <button class="btn btn-outline-secondary eye-button" type="button" id="showRenewPassword">
                          <i class="bi bi-eye eye-icon"></i>
                        </button>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="change" style="background-color: #2D9BF0;">Cambiar Contraseña</button>
                    </div>
                  </form>
                </div>

                <div class="tab-pane fade pt-3" id="profile-suscripcion">
                  <form method="post" id="changePassword">
   
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="cancelPremium" style="background-color: #2D9BF0;">Cancelar Suscripción</button>
                    </div>
                  </form>
                </div>

              </div>

            </div>
          </div>

        </div>
      </div>
    </section>
  </main>

  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>
  <script src="../js/perfil_assets.js"></script>
  <script src="../js/perfil.js"></script>

</body>

</html>