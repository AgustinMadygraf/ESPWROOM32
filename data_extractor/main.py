import os
import requests
from datetime import datetime

# Dirección del ESP32 Web Server
url_esp32 = "http://192.168.10.184"
# Dirección del servidor PHP
url_php = "https://www.profebustos.com.ar/automatizacion/procesar.php"

def main():
    try:
        # Realizar la petición GET al ESP32
        response = requests.get(url_esp32)
        
        # Verificar si la respuesta es exitosa
        if response.status_code == 200:
            # Mostrar el contenido de la respuesta
            print("Respuesta del servidor ESP32:")
            print(response.text)
            
            # Procesar los datos para convertirlos en un diccionario
            data = response.text.splitlines()
            datos = {}
            
            for line in data:
                if "Peso:" in line:
                    peso = line.split(":")[1].strip().split(" ")[0]  # Extraer solo el número
                    datos["Peso"] = float(peso)  # Convertir a float
                elif "Vueltas:" in line:
                    vueltas = line.split(":")[1].strip()  # Extraer solo el número
                    datos["Vueltas"] = int(vueltas)  # Convertir a entero
            
            # Agregar el valor de tiempo al diccionario
            datos["Tiempo"] = datetime.now().strftime("%Y-%m-%d %H:%M:%S")
            
            print("Datos procesados en diccionario:")
            print(datos)
            
            # Enviar los datos al servidor PHP
            payload = {
                'balanza': datos["Peso"],
                'contador': datos["Vueltas"]
            }
            response_php = requests.get(url_php, params=payload)
            
            # Verificar si la inserción en la base de datos fue exitosa
            if response_php.status_code == 200:
                print("Datos enviados al servidor PHP:")
                print(response_php.text)
            else:
                print(f"Error al enviar datos al servidor PHP: {response_php.status_code}")
        
        else:
            print(f"Error al conectar con el servidor ESP32: {response.status_code}")

    except requests.exceptions.RequestException as e:
        print(f"Error de conexión: {e}")

if __name__ == "__main__":
    os.system('cls')
    main()
