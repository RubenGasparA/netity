<?php
include '../includes/db_connect.php';
include "../includes/funciones.php";

// Verificar si el nombre de usuario está almacenado en la sesión
if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
} else {
  header("Location: ../index.html");
}

$idUsuario = obtenerID();



if (isset($_POST['premium'])) {
  $username = $_SESSION['username'];
  $consulta = "UPDATE usuario SET Premium = 'S' WHERE Id_Usuario = '$idUsuario'";
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-qEBMhDDZMjyzGmQJ6jbu3gq0wGof/wE78Tmif10XGm34ViRj3hKu69An8Jn1enx9b8cveC2u4bZxWwLdbUO7zA==" crossorigin="anonymous" />
  <link rel="stylesheet" href="../css/pasarela.css" />
  <title>Pasarela de Pago</title>
  <link rel="icon" href="../imagenes/LOGO1.png">
  <link rel="stylesheet" href="../css/scroll.css">
</head>

<body>
  <div class="container mt-5">
    <div class="payment-form">
      <h1 class="form-title">Pasarela de Pago</h1>
      <form action="" method="POST">
        <!-- Formulario tarjetas -->
      <div class="form-group payment-method-container">
        <input class="form-check-input" type="radio" name="payment-method" id="credit-card" value="credit-card" checked>
        <small class="text-muted credit-card-logos">
          <img src="https://1000marcas.net/wp-content/uploads/2019/12/VISA-Logo.png" alt="Visa">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" alt="Mastercard">
          <img src="https://1000marcas.net/wp-content/uploads/2020/03/logo-American-Express.png" alt="American Express">
        </small>
      </div>
      <div class="form-group payment-method-container">
        <input class="form-check-input" type="radio" name="payment-method" id="paypal" value="paypal">
        <img src="https://1000marcas.net/wp-content/uploads/2019/12/logo-Paypal.png" alt="PayPal" class="paypal-logo">
      </div>
      <div id="credit-card-form">
        <div class="form-group">
          <label for="card-number">Número de tarjeta</label>
          <input type="text" class="form-control" id="card-number" placeholder="1234 5678 9012 3456">
        </div>
        <div class="form-row">
          <div class="col">
            <label for="expiration-date">Fecha de expiración</label>
            <input type="text" class="form-control" id="expiration-date" placeholder="MM/AA">
          </div>
          <div class="col">
            <label for="cvv">CVV</label>
            <input type="text" class="form-control" id="cvv" placeholder="123">
          </div>
        </div>
        <div class="form-group mt-3">
          <label for="cardholder-name">Nombre del titular de la tarjeta</label>
          <input type="text" class="form-control" id="cardholder-name" placeholder="John Doe">
        </div>
          <button type="submit" name="premium" class="btn btn-primary mt-3">Pagar</button>
      </div>

      <div id="paypal-form" class="paypal-form" style="display: none;">
        <div class="form-group">
          <label for="paypal-email">Correo electrónico</label>
          <input type="email" class="form-control" id="paypal-email" placeholder="example@example.com">
        </div>
        <!-- Dentro del formulario de PayPal -->
        <div class="form-group">
          <label for="paypal-password">Contraseña</label>
          <div class="input-group">
            <input type="password" class="form-control" id="paypal-password" name="paypal-password" placeholder="Ingresa tu contraseña">
            <div class="input-group-append">
              <button id="password-toggle" class="btn btn-outline-secondary" type="button">
                <i class="fas fa-eye"></i>
                <i class="fas fa-eye-slash"></i>
              </button>
            </div>
          </div>
        </div>>
      </div>
      </form>
    </div>
  </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.js"></script>
    <script src="../js/pasarela.js"></script>
</body>

</html>