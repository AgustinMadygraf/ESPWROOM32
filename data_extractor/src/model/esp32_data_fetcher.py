"""
src/model/esp32_data_fetcher.py
Obtiene los datos desde el servidor ESP32.
"""
import requests
from src.logs.config_logger import logger

class ESP32DataFetcher:
    def __init__(self, url):
        self.url = url

    def fetch_data(self):
        """Obtiene los datos desde el servidor ESP32."""
        try:
            response = requests.get(self.url)
            response.raise_for_status()  # Levanta una excepción para códigos de error HTTP
            logger.debug(f"Datos recibidos del ESP32: {response.text}")
            return response.text
        except requests.exceptions.RequestException as e:
            logger.error(f"Error al conectar con el servidor ESP32: {e}")
            return None
