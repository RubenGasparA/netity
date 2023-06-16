<?php
    session_start();

function obtenerCorreoElectronicoUsuario() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Email FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $correoElectronico = $row['Email'];
        
        return $correoElectronico;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }
}

function obtenerTelefono() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Telefono FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $telefono = $row['Telefono'];
        
        return $telefono;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }
}

function obtenerNombre() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Nombre FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $nombre = $row['Nombre'];
        
        return $nombre;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }
}
function obtenerApellido1() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Apellido_1 FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $apellido1 = $row['Apellido_1'];
        
        return $apellido1;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }
}
function obtenerApellido2() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Apellido_2 FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $apellido2 = $row['Apellido_2'];
        
        return $apellido2;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }

}

function obtenerImagen() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Imagen FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $imagen = $row['Imagen'];
        
        return $imagen;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro imagen';
    }

}

function obtenerID() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Id_Usuario FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $id_Usuario = $row['Id_Usuario'];
        
        return $id_Usuario;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }
}

function obtenerConstraseña() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Contraseña FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $contraseña = $row['Contraseña'];
        
        return $contraseña;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }
}

function obtenerPremium() {
    
    // Obtener el nombre de usuario almacenado en la sesión
    $username = $_SESSION['username'];

    // Conectarse a la base de datos (puedes incluir el archivo db_connect.php aquí)
    include "db_connect.php";
    
    // Realizar la consulta SQL para obtener la columna deseada
    $sql = "SELECT Premium FROM usuario WHERE Nombre_Usuario = '$username'";
    $result = $conn->query($sql);

    // Verificar si se encontró una fila
    if ($result->num_rows == 1) {
        // Obtener el valor de la columna
        $row = $result->fetch_assoc();
        $premium = $row['Premium'];
        
        return $premium;
    } else {
        // No se encontró una fila correspondiente al usuario
        echo 'no se encontro usuario';
    }
}




?>
