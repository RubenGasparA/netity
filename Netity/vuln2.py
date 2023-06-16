import nmap
import json
from datetime import datetime

def scan_vulnerabilities(target_host):
    nm = nmap.PortScanner()
    nm.scan(target_host, '21,22,80,443', arguments='--script vulners')

    results = []

    for host in nm.all_hosts():
        host_data = {"Host": host, "Ports": []}

        for proto in nm[host].all_protocols():
            ports = nm[host][proto].keys()

            port_number = 1
            for port in ports:
                state = nm[host][proto][port]['state']
                port_data = {"Port": f"{port_number}.- {port}/{proto}", "State": state, "Vulnerabilities": []}

                if 'script' in nm[host][proto][port]:
                    vulnerabilities = nm[host][proto][port]['script']
                    for vuln in vulnerabilities:
                        port_data["Vulnerabilities"].append({vuln: vulnerabilities[vuln]})

                host_data["Ports"].append(port_data)
                port_number += 1

        results.append(host_data)

    if not results:
        print("No se encontraron hosts activos.")
    else:
        print("Escaneo de vulnerabilidades completado.")

    # Generar nombres de archivo únicos basados en la fecha y hora actual

    html_filename = f"vulnerabilities.html"
    json_filename = f"vulnerabilities.json"

    # Guardar los resultados en archivos HTML y JSON
    with open(html_filename, "w") as html_file:
        html_file.write(generate_html_report(results, target_host))

    with open(json_filename, "w") as json_file:
        json.dump(results, json_file, indent=4)

def generate_html_report(results, target_host):
    html = f"""
    <html>
    <head>
        <title>Informe de Vulnerabilidades</title>
        <style>
            body {{
                font-family: Arial, sans-serif;
                margin: 0;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background-color: #f2f9ff;
            }}
            .container {{
                background-color: transparent;
                padding: 20px;
                max-width: 600px;
                width: 100%;
                box-sizing: border-box;
            }}
            .host-title {{
                margin-bottom: 20px;
                border-bottom: 1px solid #ccc;
                padding-bottom: 10px;
            }}
            .port {{
                margin-bottom: 20px;
                padding: 10px;
                background-color: #ffffff;
            }}
            .vulnerability {{
                margin-left: 20px;
                list-style-type: square;
            }}
            .alert-types {{
                background-color: #ffffff;
                padding: 10px;
                margin-bottom: 20px;
            }}
            .alert-types ul {{
                margin-left: 20px;
                list-style-type: none;
            }}
            .alert-types .dot {{
                display: inline-block;
                width: 10px;
                height: 10px;
                margin-right: 5px;
            }}
            .low-risk .dot {{
                background-color: green;
            }}
            .important-risk .dot {{
                background-color: orange;
            }}
            .critical-risk .dot {{
                background-color: red;
            }}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="host-title">
                <h2>Tu red en Zaragoza ({target_host})</h2>
            </div>
    """

    for host_data in results:
        html += "<div class='port'>"
        html += f"<h3>Host: {host_data['Host']}</h3>"

        if not host_data["Ports"]:
            html += "<p>No se encontraron vulnerabilidades.</p>"
        else:
            for port_data in host_data["Ports"]:
                html += f"<h3>{port_data['Port']} - State: {port_data['State']}</h3>"
                if not port_data["Vulnerabilities"]:
                    html += "<p>No se encontraron vulnerabilidades.</p>"
                else:
                    html += "<ul class='vulnerability'>"
                    for vulnerability in port_data["Vulnerabilities"]:
                        for vuln, desc in vulnerability.items():
                            html += f"<li>{vuln}: {desc}</li>"
                    html += "</ul>"
        html += "</div>"

    html += """
        <div class="alert-types">
            <h3>Tipos de alertas</h3>
            <ul>
                <li class="low-risk"><span class="dot"></span>Riesgo bajo</li>
                <li class="important-risk"><span class="dot"></span>Riesgo importante</li>
                <li class="critical-risk"><span class="dot"></span>Riesgo crítico</li>
            </ul>
        </div>
    </div>
    </body>
    </html>
    """
    return html
