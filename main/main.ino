// espwroom32_v1.ino
#include <WiFi.h>
#include <WebServer.h>
#include "scale_sensor.h" // Renombrado de balanza.h a scale_sensor.h
#include <EEPROM.h>
#include <Wire.h>
#include "wifi_config.h"  // Renombrado de wifi_setup.h a wifi_config.h
#include "motor_control.h"
#include "interface.h" // Renombrado de interfaz.h a lcd_interface.h
#include <ArduinoLog.h>    // Incluimos una librería de logging

// Configura los pines de salida
const int pinOutput_ENA = 18; // enciende el motor con LOW
const int pinOutput_DIR = 19; // sentido de giro
const int pinOutput_PUL = 13; // pulso,  debe tener 1000 microsegundos entre semiciclo positivo y negativo
const int zero = 2;
int DT_hx711 = 4;
int CLK_hx711 = 5;
int peso_calibracion = 185; // Es el peso referencial a poner, en mi caso mi celular pesa 185g (SAMSUNG A20)
long scaleFactor;
int zero_button_state = 0;
int last_zero_button_state = 0;

WebServer server(80);

void handleRootRequest() {
  float peso = getWeight(); // Función que obtiene el peso actual
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
  Serial.begin(115200); // Iniciamos el serial para logs
  Log.begin(LOG_LEVEL_VERBOSE, &Serial);

  initializeLCD();
  initializeWebServer();
  setupMotor(pinOutput_ENA, pinOutput_DIR, pinOutput_PUL);
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
