# Proyecto ESP32 para Adquisición Automática de Datos

## Descripción del Proyecto

Este proyecto utiliza un ESP32 para la adquisición automática de datos relacionados con el peso de la materia prima (bobinas de papel) y el conteo de vueltas de un rodillo con circunferencia conocida. La densidad del material también es conocida [gr/m2], lo que permite un mejor control del proceso. La máquina cuenta con un corrector de banda que puede funcionar en modo manual o automático. Además, tiene la opción de realizar correcciones mediante inputs, lo que permite complementar la corrección automática con otro detector de fallos utilizando un ESP32CAM, que se desarrollará en un proyecto aparte.

## Hardware Utilizado

- **ESP32**
- **Sensor Inductivo**: Conectado al pin digital 2
- **Módulo HX711**: Utilizado para la medición del peso
- **Pantalla LCD I2C**
- **Servidor Web**: Implementado en el ESP32 para la interfaz de usuario

## Conexiones del Hardware

- **Sensor Inductivo**: Conectado al pin digital 2 del ESP32
- **Módulo HX711**:
  - Pin DT: Conectado a un pin digital del ESP32
  - Pin SCK: Conectado a un pin digital del ESP32
- **Motor**:
  - Pin ENA: Conectado al pin 18 del ESP32
  - Pin DIR: Conectado al pin 19 del ESP32
  - Pin PUL: Conectado al pin 13 del ESP32
- **Pantalla LCD I2C**: Conectada a los pines SDA y SCL del ESP32

## Funcionalidades del Software

1. **Medición del Peso**:
   - Utiliza el módulo HX711 para medir el peso de la materia prima.
   - Funciones para obtener y tarear el peso.

2. **Conteo de Vueltas**:
   - Utiliza un sensor inductivo para contar las vueltas del rodillo.
   - Funciones de interrupción para detectar cambios en el estado del sensor.

3. **Interfaz de Usuario**:
   - Pantalla LCD I2C para mostrar información relevante.
   - Servidor Web para controlar el motor y visualizar datos en tiempo real.

4. **Control del Motor**:
   - Funciones para controlar el motor en ambas direcciones (avance y reversa).
   - Integración con la interfaz web para recibir comandos.

## Dependencias

Las siguientes bibliotecas deben estar instaladas para compilar y ejecutar este proyecto:

- `WiFi`
- `WebServer`
- `EEPROM`
- `Wire`
- `ArduinoLog`
- `LiquidCrystal_I2C`
- `HX711`

## Configuración y Despliegue

### Paso 1: Instalación de Bibliotecas

Asegúrate de tener instaladas todas las dependencias mencionadas en la sección anterior. Puedes instalar estas bibliotecas utilizando el gestor de bibliotecas del Arduino IDE.

### Paso 2: Configuración del Hardware

Conecta todos los componentes de hardware según las especificaciones dadas en la sección de conexiones.

### Paso 3: Carga del Firmware

1. Abre el archivo `main.ino` en el Arduino IDE.
2. Configura el tipo de placa y el puerto correspondiente a tu ESP32.
3. Compila y carga el firmware en tu ESP32.

### Paso 4: Configuración de la Red WiFi

Modifica el archivo `wifi_config.h` para incluir las credenciales de tu red WiFi:

```cpp
// wifi_config.h
#ifndef WIFI_CONFIG_H
#define WIFI_CONFIG_H

#include <WiFi.h>
#include <WebServer.h>
#include <ArduinoLog.h>

extern WebServer server;

void initializeWebServer();
void handleRootRequest();
void handleMotorForward();
void handleMotorReverse();

// Agrega tus credenciales WiFi aquí
const char* ssid = "TU_SSID";
const char* password = "TU_PASSWORD";

#endif
```

### Paso 5: Inicialización del Sistema

1. Enciende el ESP32.
2. El sistema se conectará automáticamente a la red WiFi configurada.
3. Accede a la interfaz web a través de la dirección IP asignada al ESP32 para controlar el motor y visualizar los datos.
