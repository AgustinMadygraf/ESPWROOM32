// main.ino
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
bool zero_button_state = LOW;
bool last_zero_button_state = LOW;

bool calibrar_button_state = LOW;
bool last_calibrar_button_state = LOW;

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
    Log.info("Motor moving forward\n");
    String lcd_display_text = "Motor en avance";
    updateLCDTop(lcd_display_text);
    runMotor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL, LOW);
    String response_text = "Motor en Marcha";
    sendServerResponse(response_text);
}

/**
 * Maneja la solicitud para mover el motor hacia atrás.
 */
void handleMotorReverse() {
    Log.info("Motor moving reverse\n");
    String lcd_display_text = "Motor en reversa";
    updateLCDTop(lcd_display_text);
    runMotor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL, HIGH);
    String response_text = "Motor en reversa";
    sendServerResponse(response_text);
}

/**
 * Tarea que maneja las detecciones de vueltas.
 */
void lapDetectionTask(void *pvParameters) {
    int lapDetected;
    for (;;) {
        if (xQueueReceive(lapQueue, &lapDetected, portMAX_DELAY)) {
            lapCounter++;
            Log.info("Lap detected: %d\n", lapCounter);
        }
    }
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
    xTaskCreate(lapDetectionTask, "Lap Detection Task", 2048, NULL, 1, NULL); // Crear la tarea de detección de vueltas
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
    updateLCDBot(peso);
    tareScale(zero_button_state, last_zero_button_state);
    calibrar_button_state = digitalRead(calibracion);
    funcion_calibrar(calibrar_button_state, last_calibrar_button_state);
    last_calibrar_button_state = calibrar_button_state;
    last_zero_button_state = zero_button_state;
    updateLCDTop("Contador: " + String(lapCounter));
}
