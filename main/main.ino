//main.ino
#include <WiFi.h>
#include <WebServer.h>
#include <EEPROM.h>
#include <Wire.h>
#include <ArduinoLog.h>
#include "wifi_config.h"
#include "hardware_control.h"
#include "interface.h"
#include "counter.h"

// Pines para el control del motor
const int pinOutput_ENA = 18;
const int pinOutput_DIR = 19;
const int pinOutput_PUL = 13;

// Variables para el estado del botón de tara
int zero_button_state = 0;
int last_zero_button_state = 0;

/**
 * Maneja la solicitud raíz del servidor web.
 * Envía el peso actual y el conteo de vueltas como respuesta.
 */
void handleRootRequest() {
    Log.verbose("Handling root request\n");
    float peso = getWeight();
    String response_text = "ESP32 Web Server \n Peso: " + String(peso) + " g \n Vueltas: " + String(lapCounter);
    sendServerResponse(response_text);
}

/**
 * Maneja la solicitud para mover el motor hacia adelante.
 */
void handleMotorForward() {
    Log.info("Motor moving forward");
    String lcd_display_text = "Motor en avance";
    updateLCDStatus(lcd_display_text);
    runMotor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL, LOW);
    String response_text = "Motor en Marcha";
    sendServerResponse(response_text);
}

/**
 * Maneja la solicitud para mover el motor hacia atrás.
 */
void handleMotorReverse() {
    Log.info("Motor moving reverse");
    String lcd_display_text = "Motor en reversa";
    updateLCDStatus(lcd_display_text);
    runMotor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL, HIGH);
    String response_text = "Motor en reversa";
    sendServerResponse(response_text);
}

/**
 * Configuración inicial del ESP32.
 */
void setup() {
    Log.begin(LOG_LEVEL_VERBOSE, &Serial);
    initializeLCD();
    initializeWebServer();
    setup_motor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL);
    initializeScaleSensor();
    initializeCounter();  // Inicializar el contador de vueltas

    server.on("/", handleRootRequest);
    server.on("/ena_f", handleMotorForward);
    server.on("/ena_r", handleMotorReverse);
    server.begin();

    Log.info("Setup completado\n");
}

/**
 * Bucle principal del ESP32.
 * Se ejecuta continuamente después de la configuración inicial.
 */
void loop() {
    Log.verbose("Loop running\n");
    server.handleClient();
    zero_button_state = digitalRead(zero);
    float peso = getWeight();
    updateLCDWeight(peso);
    tareScale(zero_button_state, last_zero_button_state);
    last_zero_button_state = zero_button_state;
    updateLCDStatus("Vueltas: " + String(lapCounter));
}
