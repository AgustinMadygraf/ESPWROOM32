_

## Estructura de Carpetas y Archivos
```bash
main/
    interface.h                                   0.23kB - 003 líneas de código
    main.ino                                      0.62kB - 020 líneas de código
    wifi_manager.h                                0.38kB - 010 líneas de código
    docs/
        00-Prompt-for-ProjectAnalysis.md          3.31kB - N/A
```


## Contenido de Archivos Seleccionados

### C:\AppServ\www\ESPWROOM32\main\interface.h
```plaintext
//interface.h

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
#include <WiFi.h>
#include <LiquidCrystal_I2C.h>
#include "wifi_manager.h"

LiquidCrystal_I2C lcd(0x27, 16, 2);
WiFiManager wifiManager("Aula tecnica", "Madygraf32", lcd);

void setup() {
  // Iniciar la comunicación serial a 115200 baudios
  Serial.begin(115200);

  // Inicializar el LCD
  lcd.init();
  lcd.backlight();
  lcd.setCursor(0, 0);
  lcd.print("Conectando");
  lcd.setCursor(0, 1);
  lcd.print("a Wifi ...");

  // Conectar a la red WiFi
  wifiManager.connectToWiFi();
}

void loop() {
  // Obtener y mostrar la dirección IP cada 5 segundos
  wifiManager.printIPAddress();
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
28-06-2024 18:37:49

