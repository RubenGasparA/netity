import socket
import subprocess
from scapy.all import ARP, Ether, srp
import json

def check_device_status(ip_address):
    try:
        output = subprocess.check_output(["ping", "-n", "1", "-w", "200", ip_address], stderr=subprocess.STDOUT, universal_newlines=True)
        if "Tiempo" in output:
            return True  # El dispositivo está encendido
        else:
            return False  # El dispositivo está apagado
    except subprocess.CalledProcessError:
        return False  # El dispositivo está apagado o no responde al ping

def get_device_name(ip_address):
    try:
        return socket.gethostbyaddr(ip_address)[0]
    except socket.herror:
        return "Desconocido"

def scan_network(ip_range):
    arp = ARP(pdst=ip_range)
    ether = Ether(dst="ff:ff:ff:ff:ff:ff")
    packet = ether/arp
    result = srp(packet, timeout=3, verbose=0)[0]

    devices = []
    for sent, received in result:
        device_name = get_device_name(received.psrc)
        devices.append({'IP': received.psrc, 'MAC': received.hwsrc, 'Status': check_device_status(received.psrc), 'Nombre': device_name})
    return devices

ip_range = "192.168.1.1/24"  # Rango de direcciones IP a escanear
devices = scan_network(ip_range)

# Guardar los datos de los dispositivos en un archivo JSON
with open("vistas/devices.json", "w") as file:
    json.dump(devices, file)

# Generar archivo HTML
# Abrir el archivo en modo escritura
archivo = open("vistas/verDispositivos.php", "w")

# Escribir el contenido HTML en el archivo
contenido = """
<?php
session_start(); // Asegúrate de incluir session_start() al comienzo del archivo

// Verificar si el nombre de usuario está almacenado en la sesión
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("Location: inicio_sesion.php");
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
    <title>Netity_Home</title>
    <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sidebars/">
    <link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- Custom styles for this template -->
    <link href="../css/home.css" rel="stylesheet">
<style>
        body {
            font-family: Arial, sans-serif;
        }

        #main {
            margin-left: 40%;
            margin-top: 10%;
        }

        #devices-table {
            background-color: white;
            border-radius: 5px;
            margin-bottom: 15px;
            border-collapse: separate;
            border-spacing: 10px;
        }

        th, td {
            padding: 10px;
            border: 1px solid #dddddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>

</head>

<body>

    <!-- Aquí puedes agregar tu código de la barra de navegación -->
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
                <a href="#" class="nav-link link-body-emphasis">
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

<main id="main">
        <h1>Dispositivos encontrados en la red:</h1>
        <table id='devices-table'>
            <tr>
                <th>IP</th>
                <th>MAC</th>
                <th>Estado</th>
                <th>Nombre</th>
            </tr>
            <tbody id="devices-body">
            </tbody>
        </table>

        <button onclick='actualizarLista()'>Actualizar</button>
        <script>
            function actualizarLista() {
                fetch('devices.json')
                    .then(response => response.json())
                    .then(devices => {
                        var tbody = document.getElementById('devices-body');
                        tbody.innerHTML = '';
                        for (var i = 0; i < devices.length; i++) {
                            var device = devices[i];
                            var status = device.Status ? 'Encendido' : 'Apagado';
                            var row = document.createElement('tr');
                            var ipCell = document.createElement('td');
                            ipCell.textContent = device.IP;
                            row.appendChild(ipCell);
                            var macCell = document.createElement('td');
                            macCell.textContent = device.MAC;
                            row.appendChild(macCell);
                            var statusCell = document.createElement('td');
                            statusCell.textContent = status;
                            row.appendChild(statusCell);
                            var nameCell = document.createElement('td');
                            nameCell.textContent = device.Nombre;
                            row.appendChild(nameCell);
                            tbody.appendChild(row);
                        }
                    });
            }
        </script>
    </main>

</body>

</html>
"""

archivo.write(contenido)

# Cerrar el archivo
archivo.close()