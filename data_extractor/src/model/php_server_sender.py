"""
data_extractor/src/model/php_server_sender.py
"""

import requests
from src.logs.config_logger import logger

class PHPServerSender:
    def __init__(self, url):
        self.url = url

    def send_data(self, data):
        """Envía los datos procesados al servidor PHP."""
        if data is None:
            logger.warning("No hay datos para enviar.")
            return
        
        payload = {
            'balanza': data["Peso"],
            'contador': data["Vueltas"]
        }

        try:
            response = requests.get(self.url, params=payload)
            response.raise_for_status()
            logger.info("Datos enviados al servidor PHP con éxito.")
            logger.debug("Respuesta del servidor PHP: %s", response.text)
        except requests.exceptions.RequestException as e:
            logger.error("Error al enviar datos al servidor PHP: %s", e)
