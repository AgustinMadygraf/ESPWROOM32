_

## Estructura de Carpetas y Archivos
```bash
main/
    hardware_control.h                            0.63kB - 019 líneas de código
    interface.h                                   0.23kB - 003 líneas de código
    main.ino                                      0.93kB - 027 líneas de código
    wifi_manager.h                                0.38kB - 010 líneas de código
    docs/
        00-Prompt-for-ProjectAnalysis.md          2.72kB - N/A
```


## Contenido de Archivos Seleccionados

### C:\AppServ\www\ESPWROOM32\main\hardware_control.h
```plaintext
// hardware_control.cpp

#include "hardware_control.h"

HX711 balanza;
int DT_hx711 = 4; // Ajustar según el hardware
int CLK_hx711 = 5; // Ajustar según el hardware
long scaleFactor = 2280; // Ajustar según el hardware
int zero = 0;

void initializeScaleSensor() {
    balanza.begin(DT_hx711, CLK_hx711);
    balanza.set_scale(scaleFactor);
    balanza.tare(); // Poner la balanza en cero
}

float getWeight() {
    return balanza.get_units(10);
}

void tareScale(int zero_button_state, int last_zero_button_state) {
    if (zero_button_state == HIGH && last_zero_button_state == LOW) {
        balanza.tare();
    }
}

```

### C:\AppServ\www\ESPWROOM32\main\interface.h
```plaintext
// interface.h

#ifndef INTERFACE_H
#define INTERFACE_H

#include <LiquidCrystal_I2C.h>
#include <WiFi.h>

// Declaración de la función printIPAddress
void printIPAddress(LiquidCrystal_I2C &lcd);

#endif // INTERFACE_H

```

### C:\AppServ\www\ESPWROOM32\main\main.ino
```plaintext
// main.ino
#include <WiFi.h>
#include <WebServer.h>
#include <EEPROM.h>
#include <Wire.h>
#include "wifi_manager.h"
#include "hardware_control.h"
#include "interface.h"

int zero_button_state = 0;
int last_zero_button_state = 0;

LiquidCrystal_I2C lcd(0x27, 16, 2);
WiFiManager wifiManager("Aula tecnica", "Madygraf32", lcd);

void setup() {
  // Iniciar la comunicación serial a 115200 baudios
  Serial.begin(115200);

  // Inicializar el LCD
  lcd.init();
  lcd.backlight();
  lcd.setCursor(0, 0); // primer numero es la columna, y el segundo la fila
  lcd.print("Conectando");
  lcd.setCursor(0, 1);
  lcd.print("a Wifi ...");
  delay(500);
  
  // Conectar a la red WiFi
  wifiManager.connectToWiFi();
  wifiManager.printIPAddress();
  delay(5000);
  
  // Inicializar el sensor de peso
  initializeScaleSensor();
}

void loop() {
  // Obtener y mostrar la dirección IP cada 5 segundos
  delay(5000);
}

```

### C:\AppServ\www\ESPWROOM32\main\wifi_manager.h
```plaintext
#ifndef WIFI_MANAGER_H
#define WIFI_MANAGER_H

#include <WiFi.h>
#include <LiquidCrystal_I2C.h>

class WiFiManager {
public:
    WiFiManager(const char* ssid, const char* password, LiquidCrystal_I2C &lcd);
    void connectToWiFi();
    void printIPAddress();

private:
    const char* ssid;
    const char* password;
    LiquidCrystal_I2C &lcd;
};

#endif // WIFI_MANAGER_H

```
Fecha y hora:
28-06-2024 19:18:07

