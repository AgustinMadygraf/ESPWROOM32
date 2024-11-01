"""
data_extractor/src/controller/main_controller.py
Este módulo contiene la clase MainApp que controla el flujo principal de la aplicación.
"""

import os
import time
from src.logs.config_logger import logger

class MainApp:
    def __init__(self, fetcher, processor, sender, interval=5):
        self.fetcher = fetcher
        self.processor = processor
        self.sender = sender
        self.interval = interval  # Intervalo entre cada ciclo en segundos
        self.previous_vueltas = None  # Almacena el valor anterior de "Vueltas"

    def run(self):
        """Ejecuta el flujo completo en un bucle, con opción de modo de prueba."""
        if os.getenv("TESTING") == "1":
            logger.info("Modo de prueba activado. Ejecutando solo una iteración en modo de prueba.")
            self._execute_cycle()
            return  # Sale después de una iteración en modo de prueba
        
        while True:
            self._execute_cycle()
            time.sleep(self.interval)  # Espera el intervalo definido antes de la siguiente iteración

    def _execute_cycle(self):
        """Ejecuta una iteración del ciclo de obtención, procesamiento y envío de datos."""
        try:
            raw_data = self.fetcher.fetch_data()
            processed_data = self.processor.process_data(raw_data)

            if processed_data:
                logger.debug("Datos procesados en diccionario: %s", processed_data)

                # Enviar datos solo si hay cambios en el contador (Vueltas)
                if self.previous_vueltas != processed_data["Vueltas"]:
                    self.sender.send_data(processed_data)
                    self.previous_vueltas = processed_data["Vueltas"]  # Actualiza previous_vueltas
                else:
                    logger.debug("No hay cambios en 'Vueltas'. No se envían datos.")
            else:
                logger.warning("No se pudo procesar los datos obtenidos.")
        except Exception as e:
            logger.error("Error en el ciclo de ejecución: %s", e)
