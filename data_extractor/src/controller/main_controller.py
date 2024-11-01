import time
from src.model.esp32_data_fetcher import ESP32DataFetcher
from src.model.data_processor import DataProcessor
from src.model.php_server_sender import PHPServerSender

class MainApp:
    def __init__(self, fetcher, processor, sender, interval=5):
        self.fetcher = fetcher
        self.processor = processor
        self.sender = sender
        self.interval = interval  # Intervalo de tiempo entre cada chequeo (en segundos)
        self.previous_vueltas = None  # Almacena el valor previo de vueltas

    def run(self):
        """Ejecuta el flujo completo de obtención, procesamiento y envío de datos en un bucle infinito."""
        while True:
            raw_data = self.fetcher.fetch_data()
            processed_data = self.processor.process_data(raw_data)
            
            if processed_data:
                print("Datos procesados en diccionario:")
                print(processed_data)
                
                # Enviar datos solo si hay cambios en el contador (Vueltas)
                if self.previous_vueltas != processed_data["Vueltas"]:
                    print("Cambio detectado en el contador, enviando información...")
                    self.sender.send_data(processed_data)
                    self.previous_vueltas = processed_data["Vueltas"]  # Actualizar el valor de vueltas previo
                
            time.sleep(self.interval)  # Esperar el intervalo de tiempo antes del próximo chequeo