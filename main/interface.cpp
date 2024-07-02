// interface.cpp
#include "interface.h"

LiquidCrystal_I2C lcd(0x27, 16, 2);

void initializeLCD() {
    Serial.begin(115200);
    lcd.init();
    lcd.backlight();
}

void updateLCDBot(float peso) {
    lcd.setCursor(0, 1);
    lcd.print("Peso: ");
    lcd.print(peso, 0);
    lcd.print(" g        ");
}

void updateLCDTop(String texto_LCD) {
    lcd.setCursor(0, 0);
    lcd.print(texto_LCD);
}

void sendServerResponse(String response_text) {
    server.send(200, "text/plain", response_text);
}
