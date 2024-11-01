import os
import requests
from datetime import datetime
import time

class ESP32DataFetcher:
    def __init__(self, url):
        self.url = url

    def fetch_data(self):
        """Obtiene los datos desde el servidor ESP32."""
        try:
            response = requests.get(self.url)
            response.raise_for_status()  # Levanta una excepción para códigos de error HTTP
            return response.text
        except requests.exceptions.RequestException as e:
            print(f"Error al conectar con el servidor ESP32: {e}")
            return None


class DataProcessor:
    @staticmethod
    def process_data(raw_data):
        """Procesa la respuesta del ESP32 y la convierte en un diccionario."""
        if raw_data is None:
            return None
        
        data_lines = raw_data.splitlines()
        datos = {}

        for line in data_lines:
            if "Peso:" in line:
                peso = line.split(":")[1].strip().split(" ")[0]  # Extraer solo el número
                datos["Peso"] = float(peso)  # Convertir a float
            elif "Vueltas:" in line:
                vueltas = line.split(":")[1].strip()  # Extraer solo el número
                datos["Vueltas"] = int(vueltas)  # Convertir a entero
        
        # Agregar el valor de tiempo
        datos["Tiempo"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        
        return datos


class PHPServerSender:
    def __init__(self, url):
        self.url = url

    def send_data(self, data):
        """Envía los datos procesados al servidor PHP."""
        if data is None:
            print("No hay datos para enviar.")
            return
        
        payload = {
            'balanza': data["Peso"],
            'contador': data["Vueltas"]
        }

        try:
            response = requests.get(self.url, params=payload)
            response.raise_for_status()
            print("Datos enviados al servidor PHP:")
            print(response.text)
        except requests.exceptions.RequestException as e:
            print(f"Error al enviar datos al servidor PHP: {e}")


class MainApp:
    def __init__(self, fetcher, processor, sender, interval=5):
        self.fetcher = fetcher
        self.processor = processor
        self.sender = sender
        self.interval = interval  # Intervalo de tiempo entre cada chequeo (en segundos)
        self.previous_data = None

    def run(self):
        """Ejecuta el flujo completo de obtención, procesamiento y envío de datos en un bucle infinito."""
        while True:
            raw_data = self.fetcher.fetch_data()
            processed_data = self.processor.process_data(raw_data)
            
            if processed_data:
                print("Datos procesados en diccionario:")
                print(processed_data)
                
                # Enviar datos solo si hay cambios
                if self.previous_data != processed_data:
                    print("Cambio detectado en los datos, enviando información...")
                    self.sender.send_data(processed_data)
                    self.previous_data = processed_data  # Actualizar los datos previos
                
            time.sleep(self.interval)  # Esperar el intervalo de tiempo antes del próximo chequeo


if __name__ == "__main__":
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
