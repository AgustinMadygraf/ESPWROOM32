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
  wifiManager.printIPAddress();
  delay(5000);


}

void loop() {
  // Obtener y mostrar la dirección IP cada 5 segundos
  delay(5000);
}
