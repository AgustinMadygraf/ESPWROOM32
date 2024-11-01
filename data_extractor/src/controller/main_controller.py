"""
data_extractor/src/controller/main_controller.py
"""

import os
from src.logs.config_logger import logger  # Asegúrate de importar el logger adecuado

class MainApp:
    def __init__(self, fetcher, processor, sender, interval=5):
        self.fetcher = fetcher
        self.processor = processor
        self.sender = sender
        self.interval = interval
        self.previous_vueltas = None  # Inicializa previous_vueltas para evitar el error

    def run(self):
        """Ejecuta el flujo completo de obtención, procesamiento y envío de datos en un bucle infinito."""
        if os.getenv("TESTING") == "1":
            logger.info("Modo de prueba activado. No se ejecutará el bucle infinito.")
            return  # Evita ejecutar el bucle en modo de prueba
        
        while True:
            raw_data = self.fetcher.fetch_data()
            processed_data = self.processor.process_data(raw_data)

            if processed_data:
                logger.debug("Datos procesados en diccionario: %s", processed_data)

                # Enviar datos solo si hay cambios en el contador (Vueltas)
                if self.previous_vueltas != processed_data["Vueltas"]:
                    self.sender.send_data(processed_data)
                    self.previous_vueltas = processed_data["Vueltas"]  # Actualiza previous_vueltas
