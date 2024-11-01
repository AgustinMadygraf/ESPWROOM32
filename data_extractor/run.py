"""
run.py
Este script ejecuta la aplicación principal.
"""

from src.controller.main_controller import MainApp
from src.model.esp32_data_fetcher import ESP32DataFetcher
from src.model.data_processor import DataProcessor
from src.model.php_server_sender import PHPServerSender
import os

def run_main():
    os.system('cls')
    
    # URLs
    url_esp32 = "http://192.168.10.184"
    url_php = "https://www.profebustos.com.ar/automatizacion/procesar.php"

    # Inyección de dependencias
    fetcher = ESP32DataFetcher(url_esp32)
    processor = DataProcessor()
    sender = PHPServerSender(url_php)

    # Ejecutar la aplicación principal con un intervalo de 5 segundos
    app = MainApp(fetcher, processor, sender, interval=5)
    app.run()

if __name__ == "__main__":
    run_main()