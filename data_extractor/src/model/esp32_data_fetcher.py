import requests

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