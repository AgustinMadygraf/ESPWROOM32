from datetime import datetime

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