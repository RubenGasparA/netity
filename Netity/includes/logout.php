<?php
// Iniciar la sesión
session_start();

// Destruir todas las variables de sesión
session_unset();

// Destruir la sesión
session_destroy();

// Redireccionar a la página de inicio de sesión o a cualquier otra página que desees
header("Location: ../index.html");
exit();
?>
