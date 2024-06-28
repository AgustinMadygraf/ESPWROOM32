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
