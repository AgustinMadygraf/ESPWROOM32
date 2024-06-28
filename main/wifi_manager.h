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
