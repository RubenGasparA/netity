from flask import Flask, render_template, request, send_file
import subprocess
import json
from datetime import datetime
import nmap
import webbrowser

app = Flask(__name__)

@app.route('/ejecutar-script', methods=['POST'])
def ejecutar_script():
    # Ejecutar el script app.py utilizando subprocess
    subprocess.run(['python', 'app.py'], check=True)

    return "Script ejecutado exitosamente"


def scan_vulnerabilities(target_host):
    nm = nmap.PortScanner()
    nm.scan(target_host, '21,22,80,443', arguments='--script vulners')

    # Resto del código de la función scan_vulnerabilities ...

@app.route('/')
def index():
    return render_template('indexV.php')

@app.route('/scan', methods=['POST'])
def scan():
    target_host = request.form.get('target_host')
    scan_vulnerabilities(target_host)
    return send_file('vulnerabilities.html')

if __name__ == '__main__':
    webbrowser.open('http://localhost:5000')
    app.run(debug=True)
     
