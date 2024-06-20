// main.ino
#include <WiFi.h>
#include <WebServer.h>
#include <EEPROM.h>
#include <Wire.h>
#include <ArduinoLog.h>
#include "wifi_config.h"
#include "motor_control.h"
#include "scale_sensor.h"
#include "interface.h"

const int pinOutput_ENA = 18;
const int pinOutput_DIR = 19;
const int pinOutput_PUL = 13;
int zero_button_state = 0;
int last_zero_button_state = 0;

void handleRootRequest() {
    float peso = getWeight();
    String response_text = "ESP32 Web Server \n Peso: " + String(peso) + " g";
    sendServerResponse(response_text);
}

void handleMotorForward() {
    String lcd_display_text = "Motor en avance";
    updateLCDStatus(lcd_display_text);
    runMotor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL, LOW);
    String response_text = "Motor en Marcha";
    sendServerResponse(response_text);
}

void handleMotorReverse() {
    String lcd_display_text = "Motor en reversa";
    updateLCDStatus(lcd_display_text);
    runMotor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL, HIGH);
    String response_text = "Motor en reversa";
    sendServerResponse(response_text);
}

void setup() {
    Serial.begin(115200);
    Log.begin(LOG_LEVEL_VERBOSE, &Serial);

    initializeLCD();
    initializeWebServer();
    setup_motor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL);
    initializeScaleSensor();

    server.on("/", handleRootRequest);
    server.on("/ena_f", handleMotorForward);
    server.on("/ena_r", handleMotorReverse);
    server.begin();

    Log.info("Setup completado\n");
}

void loop() {
    server.handleClient();
    zero_button_state = digitalRead(zero);
    float peso = getWeight();
    updateLCDWeight(peso);
    tareScale(zero_button_state, last_zero_button_state);
    last_zero_button_state = zero_button_state;
}
