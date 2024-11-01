import requests

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