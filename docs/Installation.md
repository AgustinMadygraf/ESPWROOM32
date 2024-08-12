# Installation Guide

## Requisitos Previos

### Hardware Necesario
- **ESPWROOM32**
- **Sensor Inductivo**
- **Módulo HX711**
- **Salida de 4 Relés**
- **Pantalla LCD I2C**

### Software Necesario
- **Arduino IDE**: Para compilar y cargar código en el ESPWROOM32. Puedes descargarlo desde [Arduino IDE](https://www.arduino.cc/en/software).

### Dependencias
- Asegúrate de tener instaladas las siguientes bibliotecas en el Arduino IDE. Si no recuerdas todas las dependencias necesarias, estos son algunos ejemplos comunes que podrían ser requeridos:
  - `WiFi`
  - `WebServer`
  - `EEPROM`
  - `Wire`
  - `ArduinoLog`
  - `LiquidCrystal_I2C`
  - `HX711`
 ![Descripción de la imagen](docs/Img-3.png)


  Puedes instalar estas bibliotecas utilizando el gestor de bibliotecas del Arduino IDE.

## Conexión del Hardware

### Conexiones del ESPWROOM32
1. **Sensor Inductivo**: 
   - Conectar al pin digital 2 del ESPWROOM32.
2. **Módulo HX711**:
   - **Pin DT**: Conectar a un pin digital del ESPWROOM32.
   - **Pin SCK**: Conectar a un pin digital del ESPWROOM32.
3. **Salida de 4 Relés**:
   - Conectar las salidas de los relés a los pines digitales correspondientes del ESPWROOM32 según sea necesario para tu aplicación.
4. **Pantalla LCD I2C**:
   - Conectar a los pines SDA y SCL del ESPWROOM32.

**Nota**: Un diagrama de conexión detallado está pendiente de creación. Asegúrate de seguir las instrucciones de conexión de los componentes según las especificaciones del fabricante.

## Configuración del Firmware

### Carga del Firmware (si es necesario)
El firmware para el ESPWROOM32 ya está preinstalado y no es necesario actualizarlo. Sin embargo, si es necesario actualizar el firmware, sigue estos pasos:

1. Descarga el firmware desde el enlace proporcionado en Google Drive (asegúrate de tener el enlace correcto).
2. Abre el archivo `.ino` en el Arduino IDE.
3. Configura el tipo de placa y el puerto correspondiente a tu ESPWROOM32 en el menú **Herramientas**.
4. Compila y carga el firmware en tu ESPWROOM32.

### Configuración de la Red WiFi

1. Abre el archivo `wifi_config.h` y modifica las credenciales de la red WiFi:
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

2. Guarda los cambios y reinicia el ESPWROOM32 para que se conecte a la red WiFi configurada.