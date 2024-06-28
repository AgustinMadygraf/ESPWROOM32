#include "interface.h"

void printIPAddress(LiquidCrystal_I2C &lcd) {
  static IPAddress previousIP;
  IPAddress currentIP = WiFi.localIP();

  if (currentIP != previousIP) {
    lcd.setCursor(0, 1);
    lcd.print("                "); // Limpiar línea anterior
    lcd.setCursor(0, 1);
    lcd.print(currentIP.toString().c_str()); // Mostrar la dirección IP en el LCD
    previousIP = currentIP;

    Serial.print("Dirección IP: ");
    Serial.println(currentIP); // Mostrar la dirección IP en el monitor serial
  }
}
