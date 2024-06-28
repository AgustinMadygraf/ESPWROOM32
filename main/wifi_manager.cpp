#include "wifi_manager.h"

WiFiManager::WiFiManager(const char* ssid, const char* password, LiquidCrystal_I2C &lcd) 
    : ssid(ssid), password(password), lcd(lcd) {}

void WiFiManager::connectToWiFi() {
    Serial.print("Conectando a ");
    Serial.println(ssid);

    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }

    Serial.println("");
    Serial.println("Conectado a la red WiFi");
    Serial.println("Dirección IP: ");
    Serial.println(WiFi.localIP());

    lcd.setCursor(0, 0);
    lcd.print("WiFi Conectado");
    lcd.setCursor(0, 1);
    lcd.print(WiFi.localIP());
}

void WiFiManager::printIPAddress() {
    lcd.setCursor(0, 1);
    lcd.print(WiFi.localIP());
    Serial.println(WiFi.localIP());
}
