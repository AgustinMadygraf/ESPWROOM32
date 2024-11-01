"""
data_extractor/src/model/data_processor.py
"""
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
                peso_str = line.split(":")[1].strip().split(" ")[0]  # Extraer solo el número
                try:
                    datos["Peso"] = float(peso_str)  # Intentar convertir a float
                except ValueError:
                    # Si no se puede convertir, saltar la asignación de 'Peso'
                    continue
            elif "Vueltas:" in line:
                vueltas_str = line.split(":")[1].strip()  # Extraer solo el número
                try:
                    datos["Vueltas"] = int(vueltas_str)  # Intentar convertir a entero
                except ValueError:
                    # Si no se puede convertir, saltar la asignación de 'Vueltas'
                    continue
        
        # Agregar el valor de tiempo
        datos["Tiempo"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
        
        return datos
