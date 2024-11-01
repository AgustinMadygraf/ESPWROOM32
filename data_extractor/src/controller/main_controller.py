"""
data_extractor/src/controller/main_controller.py
"""

import time
from src.logs.config_logger import logger
import os

class MainApp:
    def __init__(self, fetcher, processor, sender, interval=5):
        self.fetcher = fetcher
        self.processor = processor
        self.sender = sender
        self.interval = interval

    def run(self):

        """Ejecuta el flujo completo de obtención, procesamiento y envío de datos en un bucle infinito."""
        if os.getenv("TESTING") == "1":
            return  # Evita ejecutar el bucle en modo de prueba
        while True:
            raw_data = self.fetcher.fetch_data()
            processed_data = self.processor.process_data(raw_data)
            
            if processed_data:
                logger.debug("Datos procesados en diccionario: %s", processed_data)
                
                # Enviar datos solo si hay cambios en el contador (Vueltas)
                if self.previous_vueltas != processed_data["Vueltas"]:
                    logger.info("Cambio detectado en el contador, enviando información...")
                    self.sender.send_data(processed_data)
                    self.previous_vueltas = processed_data["Vueltas"]  # Actualizar el valor de vueltas previo
                else:
                    logger.debug("No se detectaron cambios en el contador.")
                
            time.sleep(self.interval)  # Esperar el intervalo de tiempo antes del próximo chequeo
